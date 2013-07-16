<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
require_once(__DIR__ . '/../objects/GitHubCommitComment.php');
	

class GitHubReposComments extends GitHubService
{

	/**
	 * List commit comments for a repository
	 * 
	 * @return array<GitHubCommitComment>
	 */
	public function listCommitCommentsForRepository($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/comments", 'GET', $data, 200, 'GitHubCommitComment', true);
	}
	
	/**
	 * List comments for a single commit
	 * 
	 * @return array<GitHubCommitComment>
	 */
	public function listCommentsForSingleCommit($owner, $repo, $sha)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/commits/$sha/comments", 'GET', $data, 200, 'GitHubCommitComment', true);
	}
	
	/**
	 * Create a commit comment
	 * 
	 * @return GitHubCommitComment
	 */
	public function createCommitComment($owner, $repo, $id)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/comments/$id", 'GET', $data, 200, 'GitHubCommitComment');
	}
	
	/**
	 * Update a commit comment
	 * 
	 */
	public function updateCommitComment($owner, $repo, $id)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/comments/$id", 'DELETE', $data, 204, '');
	}
	
}

