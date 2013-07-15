<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubRepoSubscription.php');
	

class GitHubActivityWatching extends GitHubService
{

	/**
	 * List watchers
	 * 
	 * @return GitHubRepoSubscription
	 */
	public function listWatchers($owner, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/subscription", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/subscription]");
		
		return new GitHubRepoSubscription($response);
	}
	
	/**
	 * Set a Repository Subscription
	 * 
	 * @return GitHubRepoSubscription
	 */
	public function setRepositorySubscription($owner, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/subscription", 'PUT', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/subscription]");
		
		return new GitHubRepoSubscription($response);
	}
	
	/**
	 * Delete a Repository Subscription
	 * 
	 */
	public function deleteRepositorySubscription($owner, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/subscription", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/subscription]");
	}
	
	/**
	 * Check if you are watching a repository (LEGACY)
	 * 
	 */
	public function checkIfYouAreWatchingRepositoryLegacy($owner, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/user/subscriptions/$owner/$repo", 'PUT', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/user/subscriptions/$owner/$repo]");
	}
	
}

