<?php

require_once(__DIR__ . '/../GitHubClient.php');

	

class GitHubOrgsMembers extends GitHubService
{

	/**
	 * Members list
	 * 
	 */
	public function membersList($org, $user)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/orgs/$org/members/$user", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/orgs/$org/members/$user]");
	}
	
	/**
	 * Public members list
	 * 
	 */
	public function publicMembersList($org, $user)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/orgs/$org/public_members/$user", 'PUT', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/orgs/$org/public_members/$user]");
	}
	
}

