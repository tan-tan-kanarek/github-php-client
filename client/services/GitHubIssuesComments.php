<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubIssueComment.php');
	

class GitHubIssuesComments extends GitHubService
{

	/**
	 * List comments on an issue
	 * 
	 * @return GitHubIssueComment
	 */
	public function listCommentsOnAnIssue($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/issues/comments/$id", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/issues/comments/$id]");
		
		return new GitHubIssueComment($response);
	}
	
	/**
	 * Create a comment
	 * 
	 * @return GitHubIssueComment
	 */
	public function createComment($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/issues/comments/$id", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/issues/comments/$id]");
		
		return new GitHubIssueComment($response);
	}
	
	/**
	 * Delete a comment
	 * 
	 */
	public function deleteComment($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/issues/comments/$id", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/issues/comments/$id]");
	}
	
}

