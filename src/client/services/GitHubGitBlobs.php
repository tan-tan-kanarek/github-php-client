<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubBlob;

class GitHubGitBlobs extends GitHubService
{

	/**
	 * Get a Blob
	 * 
	 * @return array<GitHubBlob>
	 */
	public function getBlob($owner, $repo, $sha)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/git/blobs/$sha", 'GET', $data, 200, 'GitHubBlob', true);
	}
	
}
