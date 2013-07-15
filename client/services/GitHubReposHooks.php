<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubHook.php');
	

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
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/hooks/$id", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/hooks/$id]");
		
		return new GitHubHook($response);
	}
	
	/**
	 * Create a hook
	 * 
	 */
	public function createHook($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/hooks/$id", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/hooks/$id]");
	}
	
}

