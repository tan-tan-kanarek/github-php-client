<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubGittag.php');
	

class GitHubGitTags extends GitHubService
{

	/**
	 * Get a Tag
	 * 
	 * @return GitHubGittag
	 */
	public function getTag($owner, $repo, $sha)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/git/tags/$sha", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/git/tags/$sha]");
		
		return new GitHubGittag($response);
	}
	
}

