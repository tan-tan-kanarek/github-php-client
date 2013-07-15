<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubTree.php');
require_once(__DIR__ . '/../objects/GitHubTreeExtra.php');
	

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
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/git/trees/$sha", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/git/trees/$sha]");
		
		return new GitHubTree($response);
	}
	
	/**
	 * Get a Tree Recursively
	 * 
	 * @return GitHubTreeExtra
	 */
	public function getTreeRecursively($owner, $repo, $sha)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/git/trees/$sha?recursive=1", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/git/trees/$sha?recursive=1]");
		
		return new GitHubTreeExtra($response);
	}
	
}

