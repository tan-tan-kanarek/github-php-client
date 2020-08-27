<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
require_once(__DIR__ . '/../objects/GitHubUser.php');
	

class GitHubOrgsMembers extends GitHubService
{

	/**
	 * Members list
	 * 
	 * @return array<GitHubUser>
	 */
	public function membersList($org)
	{
		$data = array();
		
		return $this->client->request("/orgs/$org/members", 'GET', $data, 200, 'GitHubUser', true);
	}
	
	/**
	 * Remove member
	 * 
	 */
	public function removeMember($org, $user)
	{
		$data = array();
		
		return $this->client->request("/orgs/$org/members/$user", 'DELETE', $data, 204, '');
	}
	
	/**
	 * Remove member
	 * @deprecated
	 */
	public function responseIfRequesterIsNotAnOrganizationMember($org, $user)
	{
		return $this->removeMember($org, $user);
	}
	
	/**
	 * Public members list
	 * 
	 * @return array<GitHubUser>
	 */
	public function publicMembersList($org)
	{
		$data = array();
		
		return $this->client->request("/orgs/$org/public_members", 'GET', $data, 200, 'GitHubUser', true);
	}
	
	/**
	 * Check public membership
	 * 
	 */
	public function checkPublicMembership($org, $user)
	{
		$data = array();
		
		return $this->client->request("/orgs/$org/public_members/$user", 'PUT', $data, 204, '');
	}
	
}

