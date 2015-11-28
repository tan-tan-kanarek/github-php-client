<?php
namespace Github\Client\Services;
use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Services\GitHubActivityEventsTypes;
	

class GitHubActivityEvents extends GitHubService
{

	/**
	 * @var GitHubActivityEventsTypes
	 */
	public $types;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->types = new GitHubActivityEventsTypes($client);
	}
	
}

