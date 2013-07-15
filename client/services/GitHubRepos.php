<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/GitHubReposCollaborators.php');
require_once(__DIR__ . '/GitHubReposComments.php');
require_once(__DIR__ . '/GitHubReposCommits.php');
require_once(__DIR__ . '/GitHubReposContents.php');
require_once(__DIR__ . '/GitHubReposDownloads.php');
require_once(__DIR__ . '/GitHubReposForks.php');
require_once(__DIR__ . '/GitHubReposHooks.php');
require_once(__DIR__ . '/GitHubReposKeys.php');
require_once(__DIR__ . '/GitHubReposMerging.php');
require_once(__DIR__ . '/GitHubReposStatistics.php');
require_once(__DIR__ . '/GitHubReposStatuses.php');
	

class GitHubRepos extends GitHubService
{

	/**
	 * @var GitHubReposCollaborators
	 */
	public $collaborators;
	
	/**
	 * @var GitHubReposComments
	 */
	public $comments;
	
	/**
	 * @var GitHubReposCommits
	 */
	public $commits;
	
	/**
	 * @var GitHubReposContents
	 */
	public $contents;
	
	/**
	 * @var GitHubReposDownloads
	 */
	public $downloads;
	
	/**
	 * @var GitHubReposForks
	 */
	public $forks;
	
	/**
	 * @var GitHubReposHooks
	 */
	public $hooks;
	
	/**
	 * @var GitHubReposKeys
	 */
	public $keys;
	
	/**
	 * @var GitHubReposMerging
	 */
	public $merging;
	
	/**
	 * @var GitHubReposStatistics
	 */
	public $statistics;
	
	/**
	 * @var GitHubReposStatuses
	 */
	public $statuses;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->collaborators = new GitHubReposCollaborators($client);
		$this->comments = new GitHubReposComments($client);
		$this->commits = new GitHubReposCommits($client);
		$this->contents = new GitHubReposContents($client);
		$this->downloads = new GitHubReposDownloads($client);
		$this->forks = new GitHubReposForks($client);
		$this->hooks = new GitHubReposHooks($client);
		$this->keys = new GitHubReposKeys($client);
		$this->merging = new GitHubReposMerging($client);
		$this->statistics = new GitHubReposStatistics($client);
		$this->statuses = new GitHubReposStatuses($client);
	}
	
	/**
	 * List your repositories
	 * 
	 * @param $private boolean (Optional) - `true` makes the repository private, and
	 * 	`false` makes it public.
	 * @param $has_issues boolean (Optional) - `true` to enable issues for this repository,
	 * 	`false` to disable them. Default is `true`.
	 * @param $has_wiki boolean (Optional) - `true` to enable the wiki for this
	 * 	repository, `false` to disable it. Default is `true`.
	 * @param $has_downloads boolean (Optional) - `true` to enable downloads for this
	 * 	repository, `false` to disable them. Default is `true`.
	 * @param $default_branch String (Optional) - Update the default branch for this repository.
	 */
	public function listYourRepositories($owner, $repo, $private = null, $has_issues = null, $has_wiki = null, $has_downloads = null, $default_branch = null)
	{
		$data = array();
		if(!is_null($private))
			$data['private'] = $private;
		if(!is_null($has_issues))
			$data['has_issues'] = $has_issues;
		if(!is_null($has_wiki))
			$data['has_wiki'] = $has_wiki;
		if(!is_null($has_downloads))
			$data['has_downloads'] = $has_downloads;
		if(!is_null($default_branch))
			$data['default_branch'] = $default_branch;
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo]");
	}
	
	/**
	 * List contributors
	 * 
	 */
	public function listContributors($owner, $repo)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo]");
	}
	
}

