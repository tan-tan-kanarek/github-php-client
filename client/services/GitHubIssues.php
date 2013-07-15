<?php

require_once(__DIR__ . '/../GitHubClient.php');
require_once(__DIR__ . '/GitHubIssuesAssignees.php');
require_once(__DIR__ . '/GitHubIssuesComments.php');
require_once(__DIR__ . '/GitHubIssuesEvents.php');
require_once(__DIR__ . '/GitHubIssuesLabels.php');
require_once(__DIR__ . '/GitHubIssuesMilestones.php');
require_once(__DIR__ . '/../objects/GitHubIssue.php');
	

class GitHubIssues extends GitHubService
{

	/**
	 * @var GitHubIssuesAssignees
	 */
	public $assignees;
	
	/**
	 * @var GitHubIssuesComments
	 */
	public $comments;
	
	/**
	 * @var GitHubIssuesEvents
	 */
	public $events;
	
	/**
	 * @var GitHubIssuesLabels
	 */
	public $labels;
	
	/**
	 * @var GitHubIssuesMilestones
	 */
	public $milestones;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->assignees = new GitHubIssuesAssignees($client);
		$this->comments = new GitHubIssuesComments($client);
		$this->events = new GitHubIssuesEvents($client);
		$this->labels = new GitHubIssuesLabels($client);
		$this->milestones = new GitHubIssuesMilestones($client);
	}
	
	/**
	 * List issues
	 * 
	 * @return GitHubIssue
	 */
	public function listIssues($owner, $repo, $number)
	{
		$data = array();
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/issues/$number", 'GET', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/issues/$number]");
		
		return new GitHubIssue($response);
	}
	
	/**
	 * Create an issue
	 * 
	 * @param $assignee string (Optional) - Login for the user that this issue should be
	 * 	assigned to.
	 * @param $state string (Optional) - State of the issue: `open` or `closed`.
	 * @param $milestone number (Optional) - Milestone to associate this issue with.
	 * @param $labels array (Optional) of **strings** - Labels to associate with this
	 * 	issue. Pass one or more Labels to _replace_ the set of Labels on this
	 * 	Issue. Send an empty array (`[]`) to clear all Labels from the Issue.
	 */
	public function createAnIssue($owner, $repo, $number, $assignee = null, $state = null, $milestone = null, $labels = null)
	{
		$data = array();
		if(!is_null($assignee))
			$data['assignee'] = $assignee;
		if(!is_null($state))
			$data['state'] = $state;
		if(!is_null($milestone))
			$data['milestone'] = $milestone;
		if(!is_null($labels))
			$data['labels'] = $labels;
		
		list($httpCode, $response) = $this->request("/repos/$owner/$repo/issues/$number", 'PATCH', $data);
		if($httpCode !== 200)
			throw new GithubClientException("Expected status [200], actual status [$httpCode], URL [/repos/$owner/$repo/issues/$number]");
	}
	
}

