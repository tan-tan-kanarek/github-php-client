<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
require_once(__DIR__ . '/../objects/GitHubReadmeContent.php');
require_once(__DIR__ . '/../objects/GitHubContents.php');
    

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
	
	/**
	 * Get the content
	 * 
	 * @param $ref string (Optional) - The String name of the Commit/Branch/Tag.  Defaults to `master`.
	 * @return GitHubContent
	 */
	public function getContents($owner, $repo, $path, $ref = null)
	{
		$data = array();
		if(!is_null($ref))
			$data['ref'] = $ref;
		
		return $this->client->request("/repos/$owner/$repo/contents/$path", 'GET', $data, 200, 'GitHubContents');
	}
	
}

