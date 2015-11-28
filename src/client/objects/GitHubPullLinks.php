<?php
namespace Github\Client\Objects;

use Github\Client\GitHubObject;

class GitHubPullLinks extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		return array_merge(parent::getAttributes(), array(
		));
	}
	
}

