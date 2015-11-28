<?php
namespace Github\Client\Objects;

use Github\Client\GitHubRepo;

class GitHubFullRepo extends GitHubRepo
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

