<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubFullIssueEvent.php');
	

class GitHubIssuesEvents extends GitHubService
{

	/**
	 * Attributes
	 * 
	 * @return GitHubFullIssueEvent
	 */
	public function attributes($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/issues/events/$id", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/issues/events/$id]");
		
		return new GitHubFullIssueEvent($response);
	}
	
}

