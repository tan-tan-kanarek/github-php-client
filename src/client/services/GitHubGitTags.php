<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubGittag;

class GitHubGitTags extends GitHubService
{

	/**
	 * Get a Tag
	 * 
	 * @return GitHubGittag
	 */
	public function getTag($owner, $repo, $sha)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/git/tags/$sha", 'GET', $data, 200, 'GitHubGittag');
	}
	
}

