<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubPublicKey.php');
	

class GitHubReposKeys extends GitHubService
{

	/**
	 * List
	 * 
	 * @return GitHubPublicKey
	 */
	public function listReposKeys($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/keys/$id", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/keys/$id]");
		
		return new GitHubPublicKey($response);
	}
	
	/**
	 * Create
	 * 
	 * @return GitHubPublicKey
	 */
	public function create($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/keys/$id", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/keys/$id]");
		
		return new GitHubPublicKey($response);
	}
	
}

