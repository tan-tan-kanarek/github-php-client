<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubRef;

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
		
		return $this->client->request("/repos/$owner/$repo/git/refs/heads/skunkworkz/featureA", 'GET', $data, 200, 'GitHubRef');
	}
	
	/**
	 * Get all References
	 * 
	 */
	public function getAllReferences()
	{
		$data = array();
		
		return $this->client->request("/repos/octocat/Hello-World/git/refs/tags/v1.0", 'DELETE', $data, 204, '');
	}
	
}

