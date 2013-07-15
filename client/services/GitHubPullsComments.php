<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubPullComment.php');
	

class GitHubPullsComments extends GitHubService
{

	/**
	 * List comments on a pull request
	 * 
	 * @return GitHubPullComment
	 */
	public function listCommentsOnPullRequest($owner, $repo, $number)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/pulls/comments/$number", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/pulls/comments/$number]");
		
		return new GitHubPullComment($response);
	}
	
	/**
	 * Create a comment
	 * 
	 */
	public function createComment($owner, $repo, $number)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/pulls/comments/$number", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/pulls/comments/$number]");
	}
	
}

