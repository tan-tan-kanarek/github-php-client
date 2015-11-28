<?php
namespace Github\Client;

use Github\Client\GitHubClientBase;
use Github\Client\Services\GitHubActivity;
use Github\Client\Services\GitHubChangelog;
use Github\Client\Services\GitHubGists;
use Github\Client\Services\GitHubGit;
use Github\Client\Services\GitHubGitignore;
use Github\Client\Services\GitHubIssues;
use Github\Client\Services\GitHubLibraries;
use Github\Client\Services\GitHubMarkdown;
use Github\Client\Services\GitHubMedia;
use Github\Client\Services\GitHubMeta;
use Github\Client\Services\GitHubOauth;
use Github\Client\Services\GitHubOrgs;
use Github\Client\Services\GitHubPulls;
use Github\Client\Services\GitHubRepos;
use Github\Client\Services\GitHubSearch;
use Github\Client\Services\GitHubUsers;

class GitHubClient extends GitHubClientBase
{

	/**
	 * @var GitHubActivity
	 */
	public $activity;
	
	/**
	 * @var GitHubChangelog
	 */
	public $changelog;
	
	/**
	 * @var GitHubGists
	 */
	public $gists;
	
	/**
	 * @var GitHubGit
	 */
	public $git;
	
	/**
	 * @var GitHubGitignore
	 */
	public $gitignore;
	
	/**
	 * @var GitHubIssues
	 */
	public $issues;
	
	/**
	 * @var GitHubLibraries
	 */
	public $libraries;
	
	/**
	 * @var GitHubMarkdown
	 */
	public $markdown;
	
	/**
	 * @var GitHubMedia
	 */
	public $media;
	
	/**
	 * @var GitHubMeta
	 */
	public $meta;
	
	/**
	 * @var GitHubOauth
	 */
	public $oauth;
	
	/**
	 * @var GitHubOrgs
	 */
	public $orgs;
	
	/**
	 * @var GitHubPulls
	 */
	public $pulls;
	
	/**
	 * @var GitHubRepos
	 */
	public $repos;
	
	/**
	 * @var GitHubSearch
	 */
	public $search;
	
	/**
	 * @var GitHubUsers
	 */
	public $users;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct()
	{
		$this->activity = new GitHubActivity($this);
		$this->changelog = new GitHubChangelog($this);
		$this->gists = new GitHubGists($this);
		$this->git = new GitHubGit($this);
		$this->gitignore = new GitHubGitignore($this);
		$this->issues = new GitHubIssues($this);
		$this->libraries = new GitHubLibraries($this);
		$this->markdown = new GitHubMarkdown($this);
		$this->media = new GitHubMedia($this);
		$this->meta = new GitHubMeta($this);
		$this->oauth = new GitHubOauth($this);
		$this->orgs = new GitHubOrgs($this);
		$this->pulls = new GitHubPulls($this);
		$this->repos = new GitHubRepos($this);
		$this->search = new GitHubSearch($this);
		$this->users = new GitHubUsers($this);
	}
	
}

