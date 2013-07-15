<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubLabel extends GitHubObject
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
	protected $name;

	/**
	 * @var string
	 */
	protected $color;

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
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getColor()
	{
		return $this->color;
	}

}

