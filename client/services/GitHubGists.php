<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/GitHubGistsComments.php');
require_once(__DIR__ . '/../objects/GitHubFullGist.php');
	

class GitHubGists extends GitHubService
{

	/**
	 * @var GitHubGistsComments
	 */
	public $comments;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->comments = new GitHubGistsComments($client);
	}
	
	/**
	 * Authentication
	 * 
	 * @param $files hash (Optional) - Files that make up this gist. The key of which
	 * 	should be an _optional_ **string** filename and the value another
	 * 	_optional_ **hash** with parameters:
	 * @return GitHubFullGist
	 */
	public function authentication($id, $files = null)
	{
		$data = array();
		if(!is_null($files))
			$data['files'] = $files;
		
		list($httpCode, $response) = $this->request("/gists/$id", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/gists/$id]");
		
		return new GitHubFullGist($response);
	}
	
	/**
	 * Star a gist
	 * 
	 */
	public function starGist($id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/gists/$id/star", 'PUT', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/gists/$id/star]");
	}
	
	/**
	 * Unstar a gist
	 * 
	 */
	public function unstarGist($id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/gists/$id/star", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/gists/$id/star]");
	}
	
	/**
	 * Check if a gist is starred
	 * 
	 */
	public function checkIfGistIsStarred($id)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/gists/$id", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/gists/$id]");
	}
	
}

