<?php
require_once(__DIR__ . '/GitHubClient.php');

class GitHubService
{
	/**
	 * @var GitHubClient
	 */
	private $client;
	
	/**
	 * @param GitHubClient $client
	 */
	public function __construct(GitHubClient $client)
	{
		$this->client = $client;
	}
	
	protected function request($url, $method, array $data)
	{
		return $this->client->request($url, $method, $data);
	}
}
