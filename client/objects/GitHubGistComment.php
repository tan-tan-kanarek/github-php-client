<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubGistComment extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		
	}
	
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $url;

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
	protected $created_at;

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
	public function getUrl()
	{
		return $this->url;
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
	public function getCreatedAt()
	{
		return $this->created_at;
	}

}

