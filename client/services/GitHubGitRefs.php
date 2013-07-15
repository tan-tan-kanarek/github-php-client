<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubRef.php');
	

class GitHubGitRefs extends GitHubService
{

	/**
	 * Get a Reference
	 * 
	 * @return GitHubRef
	 */
	public function getReference($owner, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/git/refs/heads/skunkworkz/featureA", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/git/refs/heads/skunkworkz/featureA]");
		
		return new GitHubRef($response);
	}
	
	/**
	 * Get all References
	 * 
	 */
	public function getAllReferences()
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/octocat/Hello-World/git/refs/tags/v1.0", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/octocat/Hello-World/git/refs/tags/v1.0]");
	}
	
}

