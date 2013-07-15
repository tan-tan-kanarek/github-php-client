<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubGitCommit extends GitHubObject
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
	protected $message;

	/**
	 * @var array<GitHubGitCommitParents>
	 */
	protected $parents;

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

	/**
	 * @return array<GitHubGitCommitParents>
	 */
	public function getParents()
	{
		return $this->parents;
	}

}

