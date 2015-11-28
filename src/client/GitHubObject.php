<?php
namespace Github\Client;

class GitHubObject
{
	/**
	 * @param array $json
	 */
	public static function fromArray(array $json, $type)
	{

		$array = array();
		foreach($json as $jsonObject)
		{
			$object = new $type($jsonObject);
			if(method_exists($object, 'getId'))
			{
				$array[$object->getId()] = $object;
			}
			else
			{
				$array[] = $object;
			}
		}
			
		return $array;
	}
	
	/**
	 * @param stdClass $json
	 */
	public function __construct(\stdClass $json)
	{
		$attributes = $this->getAttributes();
		
		foreach($attributes as $attributeName => $attributeType)
		{
			if(!isset($json->$attributeName))
				continue;
				
			switch ($attributeType)
			{
				case 'string':
					$this->$attributeName = $json->$attributeName;
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
						$array = array();
						if(is_array($json->$attributeName))
						{
							foreach($json->$attributeName as $value)
							{
                                $class = '\\Github\Client\\Objects\\' . $attributeType;
								$array[] = new $class($value);
							}
						}
						$this->$attributeName = $array;
					}
					else
					{
                        $className = '\\Github\Client\\Objects\\' . $attributeType;
						if(!class_exists($className))
							throw new GitHubClientException("Github type [$attributeType] not found", GitHubClientException::CLASS_NOT_FOUND);
							
						$this->$attributeName = new $className($json->$attributeName);
					}
					break;
			}
		}
	}
	
	/**
	 * @return array
	 */
	protected function getAttributes()
	{
		return array();
	}
}
