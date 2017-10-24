<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubTree extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'path' => 'string',
			'mode' => 'string',
			'type' => 'string', 
			'size' => 'int',
			'sha' => 'string',
			'url' => 'string',
		));
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
	protected $path;

	/**
	 * @var string
	 */
	protected $mode;

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @var int
	 */
	protected $size;

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
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @return string
	 */
	public function getMode()
	{
		return $this->mode;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}
}

