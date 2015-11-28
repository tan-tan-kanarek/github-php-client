<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubUser;
	

class GitHubReposCollaborators extends GitHubService
{

	/**
	 * List
	 * 
	 * @return array<GitHubUser>
	 */
	public function listReposCollaborators($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/collaborators", 'GET', $data, 200, 'GitHubUser', true);
	}
	
	/**
	 * Get
	 * 
	 */
	public function get($owner, $repo, $user)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/collaborators/$user", 'PUT', $data, 204, '');
	}
	
}

