<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/GitHubUsersEmails.php');
require_once(__DIR__ . '/GitHubUsersFollowers.php');
require_once(__DIR__ . '/GitHubUsersKeys.php');
require_once(__DIR__ . '/../objects/GitHubFullUser.php');
require_once(__DIR__ . '/../objects/GitHubPrivateUser.php');
	

class GitHubUsers extends GitHubService
{

	/**
	 * @var GitHubUsersEmails
	 */
	public $emails;
	
	/**
	 * @var GitHubUsersFollowers
	 */
	public $followers;
	
	/**
	 * @var GitHubUsersKeys
	 */
	public $keys;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->emails = new GitHubUsersEmails($client);
		$this->followers = new GitHubUsersFollowers($client);
		$this->keys = new GitHubUsersKeys($client);
	}
	
	/**
	 * Get a single user
	 * 
	 * @return GitHubFullUser
	 */
	public function getSingleUser($user)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/users/$user", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/users/$user]");
		
		return new GitHubFullUser($response);
	}
	
	/**
	 * Get the authenticated user
	 * 
	 * @return GitHubPrivateUser
	 */
	public function getTheAuthenticatedUser()
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/user", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/user]");
		
		return new GitHubPrivateUser($response);
	}
	
	/**
	 * Update the authenticated user
	 * 
	 * @param $email string (Optional) - Publicly visible email address.
	 * @return GitHubFullUser
	 */
	public function updateTheAuthenticatedUser($email = null)
	{
		$data = array();
		if(!is_null($email))
			$data['email'] = $email;
		
		list($httpCode, $response) = $this->request("/user", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/user]");
		
		return new GitHubFullUser($response);
	}
	
}

