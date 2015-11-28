<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubHook;
	

class GitHubReposHooks extends GitHubService
{

	/**
	 * List
	 * 
	 * @return GitHubHook
	 */
	public function listReposHooks($owner, $repo, $id)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/hooks/$id", 'GET', $data, 200, 'GitHubHook');
	}
	
	/**
	 * Create a hook
	 * 
	 */
	public function createHook($owner, $repo, $id)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/hooks/$id", 'DELETE', $data, 204, '');
	}
	
}

