<?php

require_once(__DIR__ . '/../GitHubClient.php');

	

class GitHubReposCollaborators extends GitHubService
{

	/**
	 * List
	 * 
	 */
	public function listReposCollaborators($owner, $repo, $user)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/collaborators/$user", 'PUT', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/collaborators/$user]");
	}
	
}

