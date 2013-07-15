<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/GitHubOrgsMembers.php');
require_once(__DIR__ . '/GitHubOrgsTeams.php');
	

class GitHubOrgs extends GitHubService
{

	/**
	 * @var GitHubOrgsMembers
	 */
	public $members;
	
	/**
	 * @var GitHubOrgsTeams
	 */
	public $teams;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->members = new GitHubOrgsMembers($client);
		$this->teams = new GitHubOrgsTeams($client);
	}
	
}

