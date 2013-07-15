<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubGittag extends GitHubObject
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
	protected $tag;

	/**
	 * @var string
	 */
	protected $sha;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $message;

	/**
	 * @return string
	 */
	public function getTag()
	{
		return $this->tag;
	}

	/**
	 * @return string
	 */
	public function getSha()
	{
		return $this->sha;
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
	public function getMessage()
	{
		return $this->message;
	}

}

