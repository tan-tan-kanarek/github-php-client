<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');

	

class GitHubUsersFollowers extends GitHubService
{

	/**
	 * List followers of a user
	 * 
	 */
	public function listFollowersOfUser($user)
	{
		$data = array();
		
		return $this->client->request('/users/'.$user.'/followers', 'GET', $data, 200, 'GitHubFullUser');
	}
	
}

