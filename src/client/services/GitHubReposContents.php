<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubReadmeContent;
	

class GitHubReposContents extends GitHubService
{

	/**
	 * Get the README
	 * 
	 * @param $ref string (Optional) - The String name of the Commit/Branch/Tag.  Defaults to `master`.
	 * @return GitHubReadmeContent
	 */
	public function getTheReadme($owner, $repo, $ref = null)
	{
		$data = array();
		if(!is_null($ref))
			$data['ref'] = $ref;
		
		return $this->client->request("/repos/$owner/$repo/readme", 'GET', $data, 200, 'GitHubReadmeContent');
	}
	
}

