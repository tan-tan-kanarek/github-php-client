<?php

require_once(__DIR__ . '/../GitHubObject.php');

	

class GitHubOauthAccess extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		
	}
	
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $scopes;

	/**
	 * @var string
	 */
	protected $token;

	/**
	 * @var string
	 */
	protected $note;

	/**
	 * @var string
	 */
	protected $note_url;

	/**
	 * @var string
	 */
	protected $updated_at;

	/**
	 * @var string
	 */
	protected $created_at;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
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
	public function getScopes()
	{
		return $this->scopes;
	}

	/**
	 * @return string
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * @return string
	 */
	public function getNote()
	{
		return $this->note;
	}

	/**
	 * @return string
	 */
	public function getNoteUrl()
	{
		return $this->note_url;
	}

	/**
	 * @return string
	 */
	public function getUpdatedAt()
	{
		return $this->updated_at;
	}

	/**
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->created_at;
	}

}

