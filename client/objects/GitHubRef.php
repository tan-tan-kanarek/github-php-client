<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubRef extends GitHubObject
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
	protected $ref;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @return string
	 */
	public function getRef()
	{
		return $this->ref;
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

}

