<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubHook extends GitHubObject
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
	protected $updated_at;

	/**
	 * @var string
	 */
	protected $created_at;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $events;

	/**
	 * @var boolean
	 */
	protected $active;

	/**
	 * @var int
	 */
	protected $id;

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
	public function getUpdatedAt()
	{
		return $this->updated_at;
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
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getEvents()
	{
		return $this->events;
	}

	/**
	 * @return boolean
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

}

