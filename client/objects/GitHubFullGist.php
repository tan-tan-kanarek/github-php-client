<?php

require_once(__DIR__ . '/../GitHubGist.php');

	

class GitHubFullGist extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		
	}
	
	/**
	 * @var array<GitHubGistForksForks>
	 */
	protected $forks;

	/**
	 * @var array<GitHubGistHistoryHistory>
	 */
	protected $history;

	/**
	 * @return array<GitHubGistForksForks>
	 */
	public function getForks()
	{
		return $this->forks;
	}

	/**
	 * @return array<GitHubGistHistoryHistory>
	 */
	public function getHistory()
	{
		return $this->history;
	}

}

