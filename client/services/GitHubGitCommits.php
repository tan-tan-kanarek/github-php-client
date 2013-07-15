<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubGitCommit.php');
	

class GitHubGitCommits extends GitHubService
{

	/**
	 * Get a Commit
	 * 
	 * @return GitHubGitCommit
	 */
	public function getCommit($owner, $repo, $sha)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/git/commits/$sha", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/git/commits/$sha]");
		
		return new GitHubGitCommit($response);
	}
	
}

