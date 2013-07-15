<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/../objects/GitHubLabel.php');
	

class GitHubIssuesLabels extends GitHubService
{

	/**
	 * List all labels for this repository
	 * 
	 * @return GitHubLabel
	 */
	public function listAllLabelsForThisRepository($owner, $repo, $name)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/labels/$name", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/labels/$name]");
		
		return new GitHubLabel($response);
	}
	
	/**
	 * Create a label
	 * 
	 */
	public function createLabel($owner, $repo, $name)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/labels/$name", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/labels/$name]");
	}
	
	/**
	 * List labels on an issue
	 * 
	 */
	public function listLabelsOnAnIssue($owner, $repo, $number, $name)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/issues/$number/labels/$name", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/issues/$number/labels/$name]");
	}
	
	/**
	 * Replace all labels for an issue
	 * 
	 */
	public function replaceAllLabelsForAnIssue($owner, $repo, $number)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/issues/$number/labels", 'DELETE', $data);
		if($httpCode !== 204)
			throw new GithubClientException("Expected status [204], actual status [$httpCode], URL [/repos/$owner/$repo/issues/$number/labels]");
	}
	
}

