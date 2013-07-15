<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubMilestone.php');
	

class GitHubIssuesMilestones extends GitHubService
{

	/**
	 * List milestones for a repository
	 * 
	 * @return GitHubMilestone
	 */
	public function listMilestonesForRepository($owner, $repo, $number)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/milestones/$number", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/milestones/$number]");
		
		return new GitHubMilestone($response);
	}
	
	/**
	 * Create a milestone
	 * 
	 * @param $state string (Optional) - `open` or `closed`. Default is `open`.
	 * @param $due_on string (Optional) - ISO 8601 time.
	 * @return GitHubMilestone
	 */
	public function createMilestone($owner, $repo, $number, $state = null, $due_on = null)
	{
		$data = array();
		if(!is_null($state))
			$data['state'] = $state;
		if(!is_null($due_on))
			$data['due_on'] = $due_on;
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/milestones/$number", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/milestones/$number]");
		
		return new GitHubMilestone($response);
	}
	
	/**
	 * Delete a milestone
	 * 
	 */
	public function deleteMilestone($owner, $repo, $number)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/milestones/$number", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/milestones/$number]");
	}
	
}

