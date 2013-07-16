<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
require_once(__DIR__ . '/../objects/GitHubStatus.php');
	

class GitHubReposStatuses extends GitHubService
{

	/**
	 * List Statuses for a specific Ref
	 * 
	 * @param $ref string (Required) - Ref to list the statuses from. It can be a SHA, a branch name, or a tag name.
	 * @return array<GitHubStatus>
	 */
	public function listStatusesForSpecificRef($owner, $repo, $ref, $ref)
	{
		$data = array();
		if(!is_null($ref))
			$data['ref'] = $ref;
		
		return $this->client->request("/repos/$owner/$repo/statuses/$ref", 'GET', $data, 200, 'GitHubStatus', true);
	}
	
}

