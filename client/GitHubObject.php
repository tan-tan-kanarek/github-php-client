<?php

abstract class GitHubObject
{
	/**
	 * @param stdClass $json
	 */
	public function __construct(stdClass $json)
	{
		$attributes = $this->getAttributes();
		
		foreach($attributes as $attributeName => $attributeType)
		{
			if(!isset($json->$attributeName))
				continue;
				
			switch ($attributeType)
			{
				case 'string':
					$this->$attributeName = strval($json->$attributeName);
					break;
					
				case 'int':
					$this->$attributeName = intval($json->$attributeName);
					break;
					
				case 'boolean':
					$this->$attributeName = (bool)$json->$attributeName;
					break;
					
				default:
					$matches = null;
					if(preg_match('/^array<([^>]+)>$/', $attributeType, $matches))
					{
						$attributeType = $matches[1];
						$this->$attributeName = array();
						if(is_array($json->$attributeName))
						{
							foreach($json->$attributeName as $value)
							{
								$this->$attributeName[] = new $attributeType($value);
							}
						}
					}
					else
					{
						if(!class_exists($attributeType))
							throw new GithubClientException("Github type [$attributeType] not found", GithubClientException::CLASS_NOT_FOUND);
							
						$this->$attributeName = new $attributeType($json->$attributeName);
					}
					break;
			}
		}
	}
	
	/**
	 * @return array
	 */
	abstract protected function getAttributes();
}
