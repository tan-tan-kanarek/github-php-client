<?php
namespace Github\Client\Objects;

use Github\Client\GitHubObject;
use Github\Client\Objects\GitHubGist;

class GitHubFullGist extends GitHubObject
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

