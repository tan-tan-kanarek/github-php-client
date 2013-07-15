<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubDownload.php');
	

class GitHubReposDownloads extends GitHubService
{

	/**
	 * List downloads for a repository
	 * 
	 * @return GitHubDownload
	 */
	public function listDownloadsForRepository($owner, $repo, $id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/downloads/$id", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/downloads/$id]");
		
		return new GitHubDownload($response);
	}
	
}

