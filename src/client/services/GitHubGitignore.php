<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Objects\GitHubTemplates;
use Github\Client\Objects\GitHubTemplate;

class GitHubGitignore extends GitHubService
{

	/**
	 * Listing available templates
	 * 
	 * @return array<GitHubTemplates>
	 */
	public function listingAvailableTemplates()
	{
		$data = array();
		
		return $this->client->request("/gitignore/templates", 'GET', $data, 200, 'GitHubTemplates', true);
	}
	
	/**
	 * Get a single template
	 * 
	 * @return array<GitHubTemplate>
	 */
	public function getSingleTemplate()
	{
		$data = array();
		
		return $this->client->request("/gitignore/templates/C", 'GET', $data, 200, 'GitHubTemplate', true);
	}
	
}

