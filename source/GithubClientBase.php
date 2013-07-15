<?php

abstract class GitHubClientBase
{
	protected $url = 'https://api.github.com';

	protected $debug = false;
	protected $username = null;
	protected $password = null;
	protected $timeout = 240;
	protected $rateLimit = 0;
	protected $rateLimitRemaining = 0;

	public function setCredentials($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
	}
	
	public function setDebug($debug)
	{
		$this->debug = $debug;
	}
	
	public function setTimeout($timeout)
	{
		$this->timeout = $timeout;
	}
	
	public function getRateLimit()
	{
		return $this->rateLimit;
	}

	public function getRateLimitRemaining()
	{
		return $this->rateLimitRemaining;
	}

	/**
	 * do a github request and return array
	 *
	 * @param string $url
	 * @param string $method GET POST PUT DELETE etc...
	 * @param array $data
	 * @return array
	 */
	protected function doRequest($url, $method, array $data)
	{
		$c = curl_init();

		curl_setopt($c, CURLOPT_VERBOSE, $this->debug); 
		
		if($this->username && $this->password)
		{
			curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
			curl_setopt($c, CURLOPT_USERPWD, "$this->username:$this->password");
		}
		 
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_USERAGENT, "tan-tan.github-api");
		curl_setopt($c, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($c, CURLOPT_HEADER, true);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);

		switch($method)
		{
			case 'GET':
				curl_setopt($c, CURLOPT_HTTPGET, true);
				if(count($data))
					$url .= '?' . http_build_query($data);
				break;
				
			case 'POST':
				curl_setopt($c, CURLOPT_POST, true);
				if(count($data))
					curl_setopt($c, CURLOPT_POSTFIELDS, $data);
				break;
				
			case 'PUT':
				curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($c, CURLOPT_PUT, true);
				
				$headers = array(
					'X-HTTP-Method-Override: PUT', 
					'Content-type: application/x-www-form-urlencoded'
				);
				
				if(count($data))
				{
					$content = json_encode($data, JSON_FORCE_OBJECT);
				
					$fileName = tempnam(sys_get_temp_dir(), 'gitPut');
					file_put_contents($fileName, $content);
	 
					$f = fopen($fileName, 'rb');
					curl_setopt($c, CURLOPT_INFILE, $f);
					curl_setopt($c, CURLOPT_INFILESIZE, strlen($content));
				}
				curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
				break;
		}

		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);

		$response = curl_exec($c);
		
		curl_close($c);

		return $response;
	}

	public function request($url, $method, array $data)
	{
		$url = $this->url . $url;

		$response = $this->doRequest($url, $method, $data);
		
		// parse response
		$header = true;
		$content = array();
		$status = 200;
		foreach(explode("\r\n", $response) as $line)
		{
			if ($line == '') 
			{
				$header = false;
			}
			else if ($header) 
			{
				$line = explode(': ', $line);
				switch($line[0]) 
				{
					case 'Status': 
						$status = intval(substr($line[1], 0, 3));
						break;
						
					case 'X-RateLimit-Limit': 
						$this->rateLimit = intval($line[1]); 
						break;
						
					case 'X-RateLimit-Remaining': 
						$this->rateLimitRemaining = intval($line[1]); 
						break;
				}
			} 
			else 
			{
				$content[] = $line;
			}
		}

		return array($status, json_decode(implode("\n", $content)));
	}

	public function getFile($user, $repo, $branch, $file)
	{
		$url = 'https://raw.github.com/' . $user . '/' . $repo . '/' . $branch . '/' . ltrim($file, '/');

		return $this->doRequest($url, 'GET', array(), false);
	}
}
