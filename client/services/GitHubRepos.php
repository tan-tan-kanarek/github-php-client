<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../GitHubService.php');
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
require_once(__DIR__ . '/../objects/GitHubSimpleRepo.php');
require_once(__DIR__ . '/../objects/GitHubFullRepo.php');
require_once(__DIR__ . '/../objects/GitHubContributor.php');
require_once(__DIR__ . '/../objects/GitHubTeam.php');
require_once(__DIR__ . '/../objects/GitHubTag.php');
require_once(__DIR__ . '/../objects/GitHubBranches.php');
require_once(__DIR__ . '/../objects/GitHubBranch.php');
	

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
	 * @return array<GitHubSimpleRepo>
	 */
	public function listYourRepositories()
	{
		$data = array();
		
		return $this->client->request("/repositories", 'GET', $data, 200, 'GitHubSimpleRepo', true);
	}
	
	/**
	 * Create
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
	 * @return GitHubFullRepo
	 */
	public function create($owner, $repo, $private = null, $has_issues = null, $has_wiki = null, $has_downloads = null, $default_branch = null)
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
		
		return $this->client->request("/repos/$owner/$repo", 'PATCH', $data, 200, 'GitHubFullRepo');
	}
	
	/**
	 * List contributors
	 * 
	 * @return array<GitHubContributor>
	 */
	public function listContributors($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/contributors", 'GET', $data, 200, 'GitHubContributor', true);
	}
	
	/**
	 * List languages
	 * 
	 * @return array<GitHubTeam>
	 */
	public function listLanguages($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/teams", 'GET', $data, 200, 'GitHubTeam', true);
	}
	
	/**
	 * List Tags
	 * 
	 * @return array<GitHubTag>
	 */
	public function listTags($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/tags", 'GET', $data, 200, 'GitHubTag', true);
	}
	
	/**
	 * List Branches
	 * 
	 * @return array<GitHubBranches>
	 */
	public function listBranches($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/branches", 'GET', $data, 200, 'GitHubBranches', true);
	}
	
	/**
	 * Get Branch
	 * 
	 * @return array<GitHubBranch>
	 */
	public function getBranch($owner, $repo, $branch)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/branches/$branch", 'GET', $data, 200, 'GitHubBranch', true);
	}
	
	/**
	 * Delete a Repository
	 * 
	 */
	public function deleteRepository($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo", 'DELETE', $data, 204, '');
	}
	
}

