<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubSubscription.php');
	

class GitHubActivityNotifications extends GitHubService
{

	/**
	 * List your notifications
	 * 
	 * @param $last_read_at Time (Optional) Describes the last point that notifications were checked.  Anything
	 * 	updated since this time will not be updated.  Default: Now.  Expected in ISO
	 * 	8601 format: `YYYY-MM-DDTHH:MM:SSZ`.  Example: "2012-10-09T23:39:01Z".
	 */
	public function listYourNotifications($last_read_at = null)
	{
		$data = array();
		if(!is_null($last_read_at))
			$data['last_read_at'] = $last_read_at;
		
		list($httpCode, $response) = $this->request("/notifications", 'PUT', $data);
		if($httpCode !== 205)
			throw new GithubClientException("Expected status [205], actual status [$httpCode], URL [/notifications]");
	}
	
	/**
	 * Mark notifications as read in a repository
	 * 
	 * @param $last_read_at Time (Optional) Describes the last point that notifications were checked.  Anything
	 * 	updated since this time will not be updated.  Default: Now.  Expected in ISO
	 * 	8601 format: `YYYY-MM-DDTHH:MM:SSZ`.  Example: "2012-10-09T23:39:01Z".
	 */
	public function markNotificationsAsReadInRepository($owner, $repo, $last_read_at = null)
	{
		$data = array();
		if(!is_null($last_read_at))
			$data['last_read_at'] = $last_read_at;
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/notifications", 'PUT', $data);
		if($httpCode !== 205)
			throw new GithubClientException("Expected status [205], actual status [$httpCode], URL [/repos/$owner/$repo/notifications]");
	}
	
	/**
	 * View a single thread
	 * 
	 */
	public function viewSingleThread($id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/notifications/threads/$id", 'PATCH', $data);
		if($httpCode !== 205)
			throw new GithubClientException("Expected status [205], actual status [$httpCode], URL [/notifications/threads/$id]");
	}
	
	/**
	 * Get a Thread Subscription
	 * 
	 * @return GitHubSubscription
	 */
	public function getThreadSubscription()
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/notifications/threads/1/subscription", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/notifications/threads/1/subscription]");
		
		return new GitHubSubscription($response);
	}
	
	/**
	 * Set a Thread Subscription
	 * 
	 * @return GitHubSubscription
	 */
	public function setThreadSubscription()
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/notifications/threads/1/subscription", 'PUT', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/notifications/threads/1/subscription]");
		
		return new GitHubSubscription($response);
	}
	
	/**
	 * Delete a Thread Subscription
	 * 
	 */
	public function deleteThreadSubscription()
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/notifications/threads/1/subscription", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/notifications/threads/1/subscription]");
	}
	
}

