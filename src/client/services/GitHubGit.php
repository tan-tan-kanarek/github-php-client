<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Services\GitHubGitBlobs;
use Github\Client\Services\GitHubGitCommits;
use Github\Client\Services\GitHubGitImport;
use Github\Client\Services\GitHubGitRefs;
use Github\Client\Services\GitHubGitTags;
use Github\Client\Services\GitHubGitTrees;

class GitHubGit extends GitHubService
{

	/**
	 * @var GitHubGitBlobs
	 */
	public $blobs;
	
	/**
	 * @var GitHubGitCommits
	 */
	public $commits;
	
	/**
	 * @var GitHubGitImport
	 */
	public $import;
	
	/**
	 * @var GitHubGitRefs
	 */
	public $refs;
	
	/**
	 * @var GitHubGitTags
	 */
	public $tags;
	
	/**
	 * @var GitHubGitTrees
	 */
	public $trees;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->blobs = new GitHubGitBlobs($client);
		$this->commits = new GitHubGitCommits($client);
		$this->import = new GitHubGitImport($client);
		$this->refs = new GitHubGitRefs($client);
		$this->tags = new GitHubGitTags($client);
		$this->trees = new GitHubGitTrees($client);
	}
	
}

