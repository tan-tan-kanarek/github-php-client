<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubRepo;
	

class GitHubReposForks extends GitHubService
{

	/**
	 * List forks
	 * 
	 * @return array<GitHubRepo>
	 */
	public function listForks($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/forks", 'GET', $data, 200, 'GitHubRepo', true);
	}
	
}

