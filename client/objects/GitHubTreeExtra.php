<?php

require_once(__DIR__ . '/../GitHubObject.php');
require_once(__DIR__ . '/../objects/GitHubTree.php');

	

class GitHubTreeExtra extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'sha' => 'string',
			'url' => 'string',
			'tree' => 'array<GitHubTree>',
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
	 * @var GitHubTree
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
	 * @return GitHubTree
	 */
	public function getTree()
	{
		return $this->tree;
	}

}

