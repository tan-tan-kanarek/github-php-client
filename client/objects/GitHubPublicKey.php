<?php

require_once(__DIR__ . '/GitHubSimplePublicKey.php');



class GitHubPublicKey extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'id' => 'int',
			'key' => 'string',
			'url' => 'string',
			'title' => 'string',
			'verified' => 'boolean',
			'created_at' => 'string',
			'read_only' => 'boolean'
		));
	}

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $key;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var boolean
	 */
	protected $verified;

	/**
	 * @var string
	 */
	protected $created_at;

	/**
	 * @var boolean
	 */
	protected $read_only;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return boolean
	 */
	public function getVerified()
	{
		return $this->verified;
	}

	/**
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
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
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->created_at;
	}

	/**
	 * @return boolean
	 */
	public function getReadOnly()
	{
		return $this->read_only;
	}

}
