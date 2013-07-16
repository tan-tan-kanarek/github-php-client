<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
require_once(__DIR__ . '/../objects/GitHubTeam.php');
require_once(__DIR__ . '/../objects/GitHubFullTeam.php');
require_once(__DIR__ . '/../objects/GitHubUser.php');
require_once(__DIR__ . '/../objects/GitHubRepo.php');
	

class GitHubOrgsTeams extends GitHubService
{

	/**
	 * List teams
	 * 
	 * @return array<GitHubTeam>
	 */
	public function listTeams($org)
	{
		$data = array();
		
		return $this->client->request("/orgs/$org/teams", 'GET', $data, 200, 'GitHubTeam', true);
	}
	
	/**
	 * Get team
	 * 
	 * @return array<GitHubFullTeam>
	 */
	public function getTeam($id)
	{
		$data = array();
		
		return $this->client->request("/teams/$id", 'GET', $data, 200, 'GitHubFullTeam', true);
	}
	
	/**
	 * Create team
	 * 
	 * @return array<GitHubFullTeam>
	 */
	public function createTeam($id)
	{
		$data = array();
		
		return $this->client->request("/teams/$id", 'PATCH', $data, 200, 'GitHubFullTeam', true);
	}
	
	/**
	 * Delete team
	 * 
	 */
	public function deleteTeam($id)
	{
		$data = array();
		
		return $this->client->request("/teams/$id", 'DELETE', $data, 204, '');
	}
	
	/**
	 * List team members
	 * 
	 * @return array<GitHubUser>
	 */
	public function listTeamMembers($id)
	{
		$data = array();
		
		return $this->client->request("/teams/$id/members", 'GET', $data, 200, 'GitHubUser', true);
	}
	
	/**
	 * Get team member
	 * 
	 */
	public function getTeamMember($id, $user)
	{
		$data = array();
		
		return $this->client->request("/teams/$id/members/$user", 'PUT', $data, 204, '');
	}
	
	/**
	 * Remove team member
	 * 
	 */
	public function removeTeamMember($id, $user)
	{
		$data = array();
		
		return $this->client->request("/teams/$id/members/$user", 'DELETE', $data, 204, '');
	}
	
	/**
	 * List team repos
	 * 
	 * @return array<GitHubRepo>
	 */
	public function listTeamRepos($id)
	{
		$data = array();
		
		return $this->client->request("/teams/$id/repos", 'GET', $data, 200, 'GitHubRepo', true);
	}
	
	/**
	 * Get team repo
	 * 
	 */
	public function getTeamRepo($id, $org, $repo)
	{
		$data = array();
		
		return $this->client->request("/teams/$id/repos/$org/$repo", 'PUT', $data, 204, '');
	}
	
	/**
	 * Remove team repo
	 * 
	 */
	public function removeTeamRepo($id, $owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/teams/$id/repos/$owner/$repo", 'DELETE', $data, 204, '');
	}
	
}

