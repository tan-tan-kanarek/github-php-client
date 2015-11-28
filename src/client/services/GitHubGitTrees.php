<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubTree;
use Github\Client\Objects\GitHubTreeExtra;

class GitHubGitTrees extends GitHubService
{

	/**
	 * Get a Tree
	 * 
	 * @return GitHubTree
	 */
	public function getTree($owner, $repo, $sha)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/git/trees/$sha", 'GET', $data, 200, 'GitHubTree');
	}
	
	/**
	 * Get a Tree Recursively
	 * 
	 * @return GitHubTreeExtra
	 */
	public function getTreeRecursively($owner, $repo, $sha)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/git/trees/$sha?recursive=1", 'GET', $data, 200, 'GitHubTreeExtra');
	}
	
}

