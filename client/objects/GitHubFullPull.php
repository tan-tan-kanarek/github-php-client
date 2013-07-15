<?php

require_once(__DIR__ . '/../GitHubPull.php');

	

class GitHubFullPull extends GitHubObject
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
	protected $merge_commit_sha;

	/**
	 * @var boolean
	 */
	protected $merged;

	/**
	 * @var boolean
	 */
	protected $mergeable;

	/**
	 * @var string
	 */
	protected $merged_by;

	/**
	 * @var int
	 */
	protected $comments;

	/**
	 * @var int
	 */
	protected $commits;

	/**
	 * @var int
	 */
	protected $additions;

	/**
	 * @var int
	 */
	protected $deletions;

	/**
	 * @var int
	 */
	protected $changed_files;

	/**
	 * @return string
	 */
	public function getMergeCommitSha()
	{
		return $this->merge_commit_sha;
	}

	/**
	 * @return boolean
	 */
	public function getMerged()
	{
		return $this->merged;
	}

	/**
	 * @return boolean
	 */
	public function getMergeable()
	{
		return $this->mergeable;
	}

	/**
	 * @return string
	 */
	public function getMergedBy()
	{
		return $this->merged_by;
	}

	/**
	 * @return int
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * @return int
	 */
	public function getCommits()
	{
		return $this->commits;
	}

	/**
	 * @return int
	 */
	public function getAdditions()
	{
		return $this->additions;
	}

	/**
	 * @return int
	 */
	public function getDeletions()
	{
		return $this->deletions;
	}

	/**
	 * @return int
	 */
	public function getChangedFiles()
	{
		return $this->changed_files;
	}

}

