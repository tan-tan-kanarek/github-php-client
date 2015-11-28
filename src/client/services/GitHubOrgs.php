<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Services\GitHubOrgsMembers;
use Github\Client\Services\GitHubOrgsTeams;
use Github\Client\Services\GitHubOrgsRepos;
use Github\Client\Objects\GitHubFullOrg;
	

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
	 * @var GitHubOrgsRepos
	 */
	public $repos;

	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->members = new GitHubOrgsMembers($client);
		$this->teams = new GitHubOrgsTeams($client);
		$this->repos = new GitHubOrgsRepos($client);
	}
	
	/**
	 * List User Organizations
	 * 
	 * @return array<GitHubFullOrg>
	 */
	public function listUserOrganizations($org)
	{
		$data = array();
		
		return $this->client->request("/orgs/$org", 'GET', $data, 200, 'GitHubFullOrg', true);
	}
	
}

