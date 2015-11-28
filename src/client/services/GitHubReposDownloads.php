<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubDownload;
	

class GitHubReposDownloads extends GitHubService
{

	/**
	 * List downloads for a repository
	 * 
	 * @return array<GitHubDownload>
	 */
	public function listDownloadsForRepository($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/downloads", 'GET', $data, 200, 'GitHubDownload', true);
	}
	
	/**
	 * Get a single download
	 * 
	 * @return GitHubDownload
	 */
	public function getSingleDownload($owner, $repo, $id)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/downloads/$id", 'GET', $data, 200, 'GitHubDownload');
	}
	
}

