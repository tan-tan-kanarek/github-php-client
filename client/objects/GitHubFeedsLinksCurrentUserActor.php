<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubFeedsLinksCurrentUserActor extends GitHubObject
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
	protected $href;

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @return string
	 */
	public function getHref()
	{
		return $this->href;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

}

