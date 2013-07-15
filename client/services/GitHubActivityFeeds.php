<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubFeeds.php');
	

class GitHubActivityFeeds extends GitHubService
{

	/**
	 * List Feeds
	 * 
	 * @return GitHubFeeds
	 */
	public function listFeeds()
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/feeds", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/feeds]");
		
		return new GitHubFeeds($response);
	}
	
}

