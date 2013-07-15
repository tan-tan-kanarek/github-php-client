<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubTree extends GitHubObject
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
	protected $sha;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $tree;

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
	public function getTree()
	{
		return $this->tree;
	}

}

