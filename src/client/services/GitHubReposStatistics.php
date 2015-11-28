<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubRepoStatsContributors;
use Github\Client\Objects\GitHubRepoStatsCommitActivity;
	

class GitHubReposStatistics extends GitHubService
{

	/**
	 * A word about caching
	 * 
	 * @return array<GitHubRepoStatsContributors>
	 */
	public function aWordAboutCaching($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/stats/contributors", 'GET', $data, 200, 'GitHubRepoStatsContributors', true);
	}
	
	/**
	 * Get the last year of commit activity data
	 * 
	 * @return array<GitHubRepoStatsCommitActivity>
	 */
	public function getTheLastYearOfCommitActivityData($owner, $repo)
	{
		$data = array();
		
		return $this->client->request("/repos/$owner/$repo/stats/commit_activity", 'GET', $data, 200, 'GitHubRepoStatsCommitActivity', true);
	}
	
}

