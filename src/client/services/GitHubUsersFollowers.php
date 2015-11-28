<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;

class GitHubUsersFollowers extends GitHubService
{
	/**
	 * List followers of a user
	 * 
	 */
	public function listFollowersOfUser($user)
	{
		$data = array();
		
		return $this->client->request("/user/following/$user", 'PUT', $data, 204, '');
	}
	
}

