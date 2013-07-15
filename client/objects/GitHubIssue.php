<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubIssue extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		
	}
	
	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $html_url;

	/**
	 * @var int
	 */
	protected $number;

	/**
	 * @var string
	 */
	protected $state;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $body;

	/**
	 * @var string
	 */
	protected $user;

	/**
	 * @var string
	 */
	protected $labels;

	/**
	 * @var string
	 */
	protected $assignee;

	/**
	 * @var string
	 */
	protected $milestone;

	/**
	 * @var int
	 */
	protected $comments;

	/**
	 * @var string
	 */
	protected $closed_at;

	/**
	 * @var string
	 */
	protected $created_at;

	/**
	 * @var string
	 */
	protected $updated_at;

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @return string
	 */
	public function getHtmlUrl()
	{
		return $this->html_url;
	}

	/**
	 * @return int
	 */
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 * @return string
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * @return string
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function getLabels()
	{
		return $this->labels;
	}

	/**
	 * @return string
	 */
	public function getAssignee()
	{
		return $this->assignee;
	}

	/**
	 * @return string
	 */
	public function getMilestone()
	{
		return $this->milestone;
	}

	/**
	 * @return int
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * @return string
	 */
	public function getClosedAt()
	{
		return $this->closed_at;
	}

	/**
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->created_at;
	}

	/**
	 * @return string
	 */
	public function getUpdatedAt()
	{
		return $this->updated_at;
	}

}

