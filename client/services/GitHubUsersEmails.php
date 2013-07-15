<?php

require_once(__DIR__ . '/../GitHubClient.php');

	

class GitHubUsersEmails extends GitHubService
{

	/**
	 * List email addresses for a user
	 * 
	 */
	public function listEmailAddressesForUser()
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/user/emails", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/user/emails]");
	}
	
}

