<?php
namespace Github\Client\Objects;

use Github\Client\GitHubObject;

class GitHubFeedsLinksTimeline extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
			'href' => 'string',
			'type' => 'string',
		));
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

