<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
require_once(__DIR__ . '/../objects/GitHubRepoContent.php');
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
		
		return $this->client->request("/repos/$owner/$repo/readme", 'GET', $data, 200, 'GitHubRepoContent');
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
	
	/**
	 * Create a file
	 * 
	 * @param $path	string	Required. The content path.
	 * @param $message	string	Required. The commit message.
	 * @param $content	string	Required. The new file content, Base64 encoded.
	 * @param $branch	string	The branch name. Default: the repository’s default branch (usually master)
	 * @return GitHubRepoCommit
	 */
	public function createFile($owner, $repo, $path, $msg, $content, $branch='master')
	{
		$data = array();
		$data['message'] = $msg;
		$data['content'] = $content;
		$data['branch'] = $branch;
		
		return $this->client->request("/repos/$owner/$repo/contents/$path", 'PUT', $data, 201, 'GitHubRepoCommit');
	}

	/**
	 * Update a file
	 * 
	 * @param $path	string	Required. The content path.
	 * @param $message	string	Required. The commit message.
	 * @param $content	string	Required. The updated file content, Base64 encoded.
	 * @param $sha	string	Required. The blob SHA of the file being replaced.
	 * @param $branch	string	The branch name. Default: the repository’s default branch (usually master)
	 * @return GitHubRepoCommit
	 */
	public function updateFile($owner, $repo, $path, $msg, $content, $sha, $branch='master')
	{
		$data = array();
		$data['message'] = $msg;
		$data['content'] = $content;
		$data['ref'] = $branch;
		$data['sha'] = $sha;

		return $this->client->request("/repos/$owner/$repo/contents/$path", 'PUT', $data, 200, 'GitHubRepoCommit');
	}

	/**
	 * Delete a file
	 * 
	 * @param $path	string	Required. The content path.
	 * @param $message	string	Required. The commit message.
	 * @param $sha	string	Required. The blob SHA of the file being replaced.
	 * @param $branch	string	The branch name. Default: the repository’s default branch (usually master)
	 * @return GitHubRepoCommit
	 */
	public function deleteFile($owner, $repo, $path, $msg, $content, $sha, $branch='master')
	{
		$data = array();
		$data['message'] = $msg;
		$data['branch'] = $branch;
		$data['sha'] = $sha;

		return $this->client->request("/repos/$owner/$repo/contents/$path", 'DELETE', $data, 200, 'GitHubRepoCommit');
	}
	
}
