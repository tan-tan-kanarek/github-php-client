<?php
namespace Github\Client\Objects;

use Github\Client\GitHubObject;
use Github\Client\Objects\GitHubFeedsLinksTimeline;
use Github\Client\Objects\GitHubFeedsLinksUser;
use Github\Client\Objects\GitHubFeedsLinksCurrentUserPublic;
use Github\Client\Objects\GitHubFeedsLinksCurrentUser;
use Github\Client\Objects\GitHubFeedsLinksCurrentUserActor;
use Github\Client\Objects\GitHubFeedsLinksCurrentUserOrganization;

class GitHubFeedsLinks extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'timeline' => 'GitHubFeedsLinksTimeline',
			'user' => 'GitHubFeedsLinksUser',
			'current_user_public' => 'GitHubFeedsLinksCurrentUserPublic',
			'current_user' => 'GitHubFeedsLinksCurrentUser',
			'current_user_actor' => 'GitHubFeedsLinksCurrentUserActor',
			'current_user_organization' => 'GitHubFeedsLinksCurrentUserOrganization',
		));
	}
	
	/**
	 * @var GitHubFeedsLinksTimeline
	 */
	protected $timeline;

	/**
	 * @var GitHubFeedsLinksUser
	 */
	protected $user;

	/**
	 * @var GitHubFeedsLinksCurrentUserPublic
	 */
	protected $current_user_public;

	/**
	 * @var GitHubFeedsLinksCurrentUser
	 */
	protected $current_user;

	/**
	 * @var GitHubFeedsLinksCurrentUserActor
	 */
	protected $current_user_actor;

	/**
	 * @var GitHubFeedsLinksCurrentUserOrganization
	 */
	protected $current_user_organization;

	/**
	 * @return GitHubFeedsLinksTimeline
	 */
	public function getTimeline()
	{
		return $this->timeline;
	}

	/**
	 * @return GitHubFeedsLinksUser
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return GitHubFeedsLinksCurrentUserPublic
	 */
	public function getCurrentUserPublic()
	{
		return $this->current_user_public;
	}

	/**
	 * @return GitHubFeedsLinksCurrentUser
	 */
	public function getCurrentUser()
	{
		return $this->current_user;
	}

	/**
	 * @return GitHubFeedsLinksCurrentUserActor
	 */
	public function getCurrentUserActor()
	{
		return $this->current_user_actor;
	}

	/**
	 * @return GitHubFeedsLinksCurrentUserOrganization
	 */
	public function getCurrentUserOrganization()
	{
		return $this->current_user_organization;
	}

}

