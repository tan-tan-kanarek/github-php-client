<?php
namespace Github\Source;

use Github\Client\GitHubClient;


class GitHubService
{
	/**
	 * @var GitHubClient
	 */
	protected $client;
	
	/**
	 * @param GitHubClient $client
	 */
	public function __construct(GitHubClient $client)
	{
		$this->client = $client;
	}
}
