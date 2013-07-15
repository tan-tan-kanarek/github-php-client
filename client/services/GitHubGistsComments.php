<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubGistComment.php');
	

class GitHubGistsComments extends GitHubService
{

	/**
	 * List comments on a gist
	 * 
	 * @return GitHubGistComment
	 */
	public function listCommentsOnGist($gist_id, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/gists/$gist_id/comments/$id", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/gists/$gist_id/comments/$id]");
		
		return new GitHubGistComment($response);
	}
	
	/**
	 * Create a comment
	 * 
	 * @return GitHubGistComment
	 */
	public function createComment($gist_id, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/gists/$gist_id/comments/$id", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/gists/$gist_id/comments/$id]");
		
		return new GitHubGistComment($response);
	}
	
	/**
	 * Delete a comment
	 * 
	 */
	public function deleteComment($gist_id, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/gists/$gist_id/comments/$id", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/gists/$gist_id/comments/$id]");
	}
	
}

