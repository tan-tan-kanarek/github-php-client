<?php

require_once(__DIR__ . '/../GitHubClient.php');

	

class GitHubOrgsTeams extends GitHubService
{

	/**
	 * List teams
	 * 
	 */
	public function listTeams($id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/teams/$id", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/teams/$id]");
	}
	
	/**
	 * List team members
	 * 
	 */
	public function listTeamMembers($id, $user)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/teams/$id/members/$user", 'PUT', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/teams/$id/members/$user]");
	}
	
	/**
	 * Remove team member
	 * 
	 */
	public function removeTeamMember($id, $user)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/teams/$id/members/$user", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/teams/$id/members/$user]");
	}
	
	/**
	 * List team repos
	 * 
	 */
	public function listTeamRepos($id, $org, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/teams/$id/repos/$org/$repo", 'PUT', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/teams/$id/repos/$org/$repo]");
	}
	
	/**
	 * Remove team repo
	 * 
	 */
	public function removeTeamRepo($id, $owner, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/teams/$id/repos/$owner/$repo", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/teams/$id/repos/$owner/$repo]");
	}
	
}

