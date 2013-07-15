<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubCommitComment.php');
	

class GitHubReposComments extends GitHubService
{

	/**
	 * List commit comments for a repository
	 * 
	 * @return GitHubCommitComment
	 */
	public function listCommitCommentsForRepository($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/comments/$id", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/comments/$id]");
		
		return new GitHubCommitComment($response);
	}
	
	/**
	 * Update a commit comment
	 * 
	 */
	public function updateCommitComment($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/comments/$id", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/comments/$id]");
	}
	
}

