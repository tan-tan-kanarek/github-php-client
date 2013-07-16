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
	
	protected $page = null;
	protected $pageSize = 100;
	
	protected $lastPage = null;
	protected $lastUrl = null;
	protected $lastMethod = null;
	protected $lastData = null;
	protected $lastReturnType = null;
	protected $lastReturnIsArray = null;
	protected $lastExpectedHttpCode = null;
	protected $pageData = array();

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
	
	protected function resetPage()
	{
		$this->lastPage = $this->page;
		$this->page = null;
	}
	
	public function setPage($page = 1)
	{
		$this->page = $page;
	}
	
	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
	}
	
	public function getLastPage()
	{
		if(!isset($this->pageData['last']))
			throw new GithubClientException("Last page not defined", GithubClientException::PAGE_INVALID);
			
		if(isset($this->pageData['last']['page']))
			$this->page = $this->pageData['last']['page'];
			
		return $this->requestLast($this->pageData['last']);
	}
	
	public function getFirstPage()
	{
		if(isset($this->pageData['first']))
		{
			if(isset($this->pageData['first']['page']))
				$this->page = $this->pageData['first']['page'];
			
			return $this->requestLast($this->pageData['first']);
		}
		
		$this->page = 1;
		return $this->requestLast($this->lastData);
	}
	
	public function getNextPage()
	{
		if(isset($this->pageData['next']))
		{
			if(isset($this->pageData['next']['page']))
				$this->page = $this->pageData['next']['page'];
			
			return $this->requestLast($this->pageData['next']);
		}
		
		if(is_null($this->page))
			throw new GithubClientException("Page not defined", GithubClientException::PAGE_INVALID);
			
		$this->page = $this->lastPage + 1;
		return $this->requestLast($this->lastData);
	}
	
	public function getPreviousPage()
	{
		if(isset($this->pageData['prev']))
		{
			if(isset($this->pageData['prev']['page']))
				$this->page = $this->pageData['prev']['page'];
			
			return $this->requestLast($this->pageData['prev']);
		}
		
		if(is_null($this->page))
			throw new GithubClientException("Page not defined", GithubClientException::PAGE_INVALID);
			
		$this->page = $this->lastPage - 1;
		return $this->requestLast($this->lastData);
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

	protected function requestLast(array $data)
	{
		return $this->request($this->lastUrl, $this->lastMethod, $data, $this->lastExpectedHttpCode, $this->lastReturnType, $this->lastReturnIsArray);
	}
	
	public function request($url, $method, array $data, $expectedHttpCode, $returnType, $isArray = false)
	{
		$this->lastUrl = $url;
		$this->lastMethod = $method;
		$this->lastData = $data;
		$this->lastExpectedHttpCode = $expectedHttpCode;
		$this->lastReturnIsArray = $isArray;
		$this->lastReturnType = $returnType;
		
		if(!is_null($this->page))
		{
			if(!is_numeric($this->page) || $this->page <= 0)
			{
				$this->resetPage();
				throw new GithubClientException("Page must be positive value", GithubClientException::PAGE_INVALID);
			}
				
			if(!is_numeric($this->pageSize) || $this->pageSize <= 0 || $this->pageSize > 100)
			{
				$this->resetPage();
				throw new GithubClientException("Page size must be positive value, maximum value is 100", GithubClientException::PAGE_SIZE_INVALID);
			}
				
			$data['page'] = $this->page;
			$data['per_page'] = $this->pageSize;
			
			$this->resetPage();
		}
		
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
						
					case 'Link':
						$matches = null;
						if(preg_match_all('/<https:\/\/api\.github\.com\/[^?]+\?([^>]+)>; rel="([^"]+)"/', $line[1], $matches))
						{
							foreach($matches[2] as $index => $page)
							{
								$this->pageData[$page] = array();
								$requestParts = explode('&', $matches[1][$index]);
								foreach($requestParts as $requestPart)
								{
									list($field, $value) = explode('=', $requestPart, 2);
									$this->pageData[$page][$field] = $value;
								}
							}
						} 
						break;
				}
			} 
			else 
			{
				$content[] = $line;
			}
		}

		if($status !== $expectedHttpCode)
			throw new GithubClientException("Expected status [$expectedHttpCode], actual status [$status], URL [$url]", GithubClientException::INVALID_HTTP_CODE);
		
		$response = json_decode(implode("\n", $content));
		if($isArray)
			return GitHubObject::fromArray($response, $returnType);
		else
			return new $returnType($response);
	}

	public function getFile($user, $repo, $branch, $file)
	{
		$url = 'https://raw.github.com/' . $user . '/' . $repo . '/' . $branch . '/' . ltrim($file, '/');

		return $this->doRequest($url, 'GET', array(), false);
	}
}
