<?php
namespace Github\Client\Objects;

use Github\Client\GitHubObject;

class GitHubSimplePublicKey extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'id' => 'int',
			'key' => 'string',
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
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

}

