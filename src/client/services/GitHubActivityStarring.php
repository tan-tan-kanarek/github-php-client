<?php
namespace Github\Client\Services;
use Github\Client\GitHubClient;
use Github\Client\GitHubService;

class GitHubActivityStarring extends GitHubService
{

	/**
	 * List Stargazers
	 * 
	 */
	public function listStargazers($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/user/starred/$owner/$repo", 'PUT', $data, 204, '');
	}
	
}

