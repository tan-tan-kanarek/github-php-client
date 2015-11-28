<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubPublicKey;
	

class GitHubReposKeys extends GitHubService
{

	/**
	 * List
	 * 
	 * @return array<GitHubPublicKey>
	 */
	public function listReposKeys($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/keys", 'GET', $data, 200, 'GitHubPublicKey', true);
	}
	
	/**
	 * Get
	 * 
	 * @return GitHubPublicKey
	 */
	public function get($owner, $repo, $id)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/keys/$id", 'GET', $data, 200, 'GitHubPublicKey');
	}
	
	/**
	 * Create
	 * 
	 * @return GitHubPublicKey
	 */
	public function create($owner, $repo, $id)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/keys/$id", 'PATCH', $data, 200, 'GitHubPublicKey');
	}
	
}

