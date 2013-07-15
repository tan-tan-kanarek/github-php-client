<?php

require_once(__DIR__ . '/../GitHubClient.php');

	

class GitHubActivityStarring extends GitHubService
{

	/**
	 * List Stargazers
	 * 
	 */
	public function listStargazers($owner, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/user/watched/$owner/$repo", 'PUT', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/user/watched/$owner/$repo]");
	}
	
}

