<?php
namespace Github\Client\Services;
use Github\Client\GitHubClient;
use Github\Client\GitHubService;
use Github\Client\Services\GitHubActivityEvents;
use Github\Client\Services\GitHubActivityFeeds;
use Github\Client\Services\GitHubActivityNotifications;
use Github\Client\Services\GitHubActivitySettings;
use Github\Client\Services\GitHubActivityStarring;
use Github\Client\Services\GitHubActivityWatching;
	

class GitHubActivity extends GitHubService
{

	/**
	 * @var GitHubActivityEvents
	 */
	public $events;
	
	/**
	 * @var GitHubActivityFeeds
	 */
	public $feeds;
	
	/**
	 * @var GitHubActivityNotifications
	 */
	public $notifications;
	
	/**
	 * @var GitHubActivitySettings
	 */
	public $settings;
	
	/**
	 * @var GitHubActivityStarring
	 */
	public $starring;
	
	/**
	 * @var GitHubActivityWatching
	 */
	public $watching;
	
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient $client)
	{
		parent::__construct($client);
		
		$this->events = new GitHubActivityEvents($client);
		$this->feeds = new GitHubActivityFeeds($client);
		$this->notifications = new GitHubActivityNotifications($client);
		$this->settings = new GitHubActivitySettings($client);
		$this->starring = new GitHubActivityStarring($client);
		$this->watching = new GitHubActivityWatching($client);
	}
	
}

