<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/GitHubPullsComments.php');
require_once(__DIR__ . '/../objects/GitHubFullPull.php');
	

class GitHubPulls extends GitHubService
{

	/**
	 * @var GitHubPullsComments
	 */
	public $comments;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->comments = new GitHubPullsComments($client);
	}
	
	/**
	 * Link Relations
	 * 
	 * @return GitHubFullPull
	 */
	public function linkRelations($owner, $repo, $number)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/pulls/$number", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/pulls/$number]");
		
		return new GitHubFullPull($response);
	}
	
	/**
	 * Mergability
	 * 
	 * @param $state string (Optional) - State of this Pull Request. Valid values are
	 * 	`open` and `closed`.
	 * @return GitHubFullPull
	 */
	public function mergability($owner, $repo, $number, $state = null)
	{
		$data = array();
		if(!is_null($state))
			$data['state'] = $state;
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/pulls/$number", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/pulls/$number]");
		
		return new GitHubFullPull($response);
	}
	
}

