<?php
namespace Github\Client\Services;
use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubFeeds;
	

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
		
		return $this->client->request("/feeds", 'GET', $data, 200, 'GitHubFeeds');
	}
	
}

