<?php

require_once(__DIR__ . '/../GitHubObject.php');



class GitHubLabel extends GitHubObject
{
    /* (non-PHPdoc)
     * @see GitHubObject::getAttributes()
     */
    protected function getAttributes()
    {
        return array_merge(parent::getAttributes(), array(
            'url' => 'string',
            'name' => 'string',
            'color' => 'string',
            'description' => 'string'
        ));
    }

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $description;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
