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
			'verified' => 'boolean',
			'url' => 'string',
			'title' => 'string',
		));
	}

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var boolean
	 */
	protected $verified;

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

}
