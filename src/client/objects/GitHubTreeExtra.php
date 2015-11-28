<?php
namespace Github\Client\Objects;

use Github\Client\GitHubObject;

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

}

