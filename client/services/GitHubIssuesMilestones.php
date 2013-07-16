<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
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
		
		return $this->client->request("/repos/$owner/$repo/milestones/$number", 'GET', $data, 200, 'GitHubMilestone');
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
		
		return $this->client->request("/repos/$owner/$repo/milestones/$number", 'PATCH', $data, 200, 'GitHubMilestone');
	}
	
	/**
	 * Delete a milestone
	 * 
	 */
	public function deleteMilestone($owner, $repo, $number)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/milestones/$number", 'DELETE', $data, 204, '');
	}
	
}

