<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubCommitComment extends GitHubObject
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
	protected $html_url;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $body;

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var int
	 */
	protected $position;

	/**
	 * @var int
	 */
	protected $line;

	/**
	 * @var string
	 */
	protected $commit_id;

	/**
	 * @var string
	 */
	protected $user;

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
	public function getHtmlUrl()
	{
		return $this->html_url;
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
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
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @return int
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * @return int
	 */
	public function getLine()
	{
		return $this->line;
	}

	/**
	 * @return string
	 */
	public function getCommitId()
	{
		return $this->commit_id;
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

