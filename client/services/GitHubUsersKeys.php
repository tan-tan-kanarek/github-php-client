<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubPublicKey.php');
	

class GitHubUsersKeys extends GitHubService
{

	/**
	 * List public keys for a user
	 * 
	 * @return GitHubPublicKey
	 */
	public function listPublicKeysForUser($id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/user/keys/$id", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/user/keys/$id]");
		
		return new GitHubPublicKey($response);
	}
	
	/**
	 * Create a public key
	 * 
	 * @return GitHubPublicKey
	 */
	public function createPublicKey($id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/user/keys/$id", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/user/keys/$id]");
		
		return new GitHubPublicKey($response);
	}
	
}

