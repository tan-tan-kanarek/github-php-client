<?php

chdir(__DIR__);

if(!file_exists(__DIR__ . '/client'))
	mkdir(__DIR__ . '/client');
if(!file_exists(__DIR__ . '/client/services'))
	mkdir(__DIR__ . '/client/services');
if(!file_exists(__DIR__ . '/client/objects'))
	mkdir(__DIR__ . '/client/objects');
	
$resources = str_replace("\r", '', file_get_contents(__DIR__ . '/resources.rb'));

$sourceDir = dir(__DIR__ . '/source');
while (false !== ($entry = $sourceDir->read())) 
{
	if($entry[0] != '.')
		copy(__DIR__ . '/source/' . $entry, __DIR__ . '/client/' . $entry);
}
$sourceDir->close();

$classTree = array();
$objects = array();
scanDirectory(realpath('v3'));
generateGithubClient();
generateGithubObjects();

function scanDirectory($dir, $classPath = array())
{
	global $classTree;
	
	$d = dir($dir);
	echo "Scanning directory: " . $d->path . "\n";
	while (false !== ($entry = $d->read())) 
	{
		if($entry[0] == '.')
			continue;

		$entryPath = $d->path . DIRECTORY_SEPARATOR . $entry;
		$entryClassPath = $classPath;
		$entryClassPath[] = preg_replace('/.md$/', '', $entry);
		if(is_dir($entryPath))
		{
			scanDirectory($entryPath, $entryClassPath);
		}
		else
		{
			$entryName = implode('', array_map('ucfirst', $entryClassPath));
			$parentClassPath = '/' . implode('/', $classPath);
			if(!isset($classTree[$parentClassPath]))
				$classTree[$parentClassPath] = array();
				
			$classTree[$parentClassPath][$entryPath] = $entryName;
		}
	}
	$d->close();
}

function generateGithubClient()
{
	global $classTree;
	
	$requires = array();
	
	$class = "
class GitHubClient extends GitHubClientBase
{
";

	foreach($classTree['/'] as $file => $className)
	{
		generateGithubService($file, $className);
		$requires["GitHub$className"] = "require_once(__DIR__ . '/services/GitHub$className.php');";
		$varName = lcfirst($className);
		$class .= "
	/**
	 * @var GitHub$className
	 */
	public \$$varName;
	";
	}
	
	$class .= "
	
	/**
	 * Initialize sub services
	 */
	public function __construct()
	{
		parent::__construct();
		";
		
	foreach($classTree['/'] as $file => $className)
	{
		$varName = lcfirst($className);
		$class .= "
		\$this->$varName = new GitHub$className(\$this);";
	}
		
	$class .= "
	}
	";
	
	$class .= "
}
";
	
	$requires = implode("\n", $requires);
	$php = "<?php

require_once(__DIR__ . '/GitHubClientBase.php');
$requires

$class
";

	file_put_contents(__DIR__ . "/client/GitHubClient.php", $php);
}

function generateGithubService($file, $name)
{
	global $classTree, $objects;
	
	$requires = array();
	$classPath = str_replace(array(__DIR__, '.md', '\\v3', '\\'), array('', '', '', '/'), $file);
	echo "Generating service: $name [$classPath]\n";
	$content = file_get_contents($file);
'
## List your notifications

List all notifications for the current user, grouped by repository.

    GET /notifications
';
	
	preg_match_all('/## ([^\n]+)\n\n(.*)(\n\n)?    (GET|PUT|PATCH|DELETE) ([^\n]+)\n\n(### (Parameters|Input)\n\n([^#]+))?### Response\n\n<%= headers (\d+) %>(\n<%= json :([^\s]+) %>)?\n\n/sU', $content, $matches);
	
	$class = "
class GitHub$name extends GitHubService
{
";

	if(isset($classTree[$classPath]))
	{
		foreach($classTree[$classPath] as $file => $className)
		{
			$requires["GitHub$className"] = "require_once(__DIR__ . '/GitHub$className.php');";
			$varName = lcfirst(preg_replace("/^$name/", '', $className));
			$class .= "
	/**
	 * @var GitHub$className
	 */
	public \$$varName;
	";
		}
	
		$class .= "
	
	/**
	 * Initialize sub services
	 */
	public function __construct(GitHubClient \$client)
	{
		parent::__construct(\$client);
		";
		
		foreach($classTree[$classPath] as $file => $className)
		{
			$varName = lcfirst(preg_replace("/^$name/", '', $className));
			$class .= "
		\$this->$varName = new GitHub$className(\$client);";
		}
		
		$class .= "
	}
	";
	}
	
	foreach($matches[1] as $index => $description)
	{
		$methodName = lcfirst(str_replace(array(' A ', ' '), array('', ''), ucwords(preg_replace('/[^\w]/', ' ', strtolower($description)))));
		if($methodName == 'list')
			$methodName .= $name;
			
		$httpMethod = $matches[4][$index];
		$url = str_replace(':', '$', $matches[5][$index]);
		$arguments = array();
		$dataArguments = array();
		if(preg_match_all('/\/(\$[^\/?]+)/', $url, $argumentsMatches))
			$arguments = $argumentsMatches[1];
		
		$paremetersDescription = $matches[8][$index];
		$docCommentParameters = array();
		$paremetersMatches = null;
		if($paremetersDescription && preg_match_all('/([^\n]+)\n: _([^_]+)_ \*\*([^\*]+)\*\* (.+)\n\n/sU', $paremetersDescription, $paremetersMatches))
		{
			foreach($paremetersMatches[1] as $index => $parameterName)
			{
				$parameterName = preg_replace('/[^\w]/', '', $parameterName);
				$parameterRequirement = $paremetersMatches[2][$index];
				$parameterType = $paremetersMatches[3][$index];
				$parameterDescription = $paremetersMatches[4][$index];
				$parameterDescription = implode("\n	 * \t", explode("\n", $parameterDescription));
				$docCommentParameters[] = "\$$parameterName $parameterType ($parameterRequirement) $parameterDescription";
				$argument = "\$$parameterName";
				$dataArguments[] = $parameterName;
				if($parameterRequirement == 'Optional')
					$argument .= ' = null';
					
				$arguments[] = $argument;
			}
		}
		
		$expectedStatus = 200;
		if(isset($matches[9][$index]))
			$expectedStatus = $matches[9][$index];
		
		$arguments = implode(', ', $arguments);
		$class .= "
	/**
	 * $description
	 * ";
		
		foreach($docCommentParameters as $docCommentParameter)
		{
			$class .= "
	 * @param $docCommentParameter";
		}
						
		$responseType = null;
		$returnType = null;
		
		if(isset($matches[11][$index]))
			$responseType = $matches[11][$index];
			
		if($responseType)
		{
			$objects[] = $responseType;
			$returnType = gitHubClassName($responseType);
			$requires[$returnType] = "require_once(__DIR__ . '/../objects/$returnType.php');";
			$class .= "
	 * @return $returnType";
		}
	 
		$class .= "
	 */
	public function $methodName($arguments)
	{
		\$data = array();";
		
		foreach($dataArguments as $dataArgument)
		{
			$class .= "
		if(!is_null(\$$dataArgument))
			\$data['$dataArgument'] = \$$dataArgument;";
		}
		
		$class .= "
		
		list(\$httpCode, \$response) = \$this->request(\"$url\", '$httpMethod', \$data);
		if(\$httpCode !== $expectedStatus)
			throw new GithubClientException(\"Expected status [$expectedStatus], actual status [\$httpCode], URL [$url]\");";
		
		if($returnType)
		{
			$class .= "
		
		return new $returnType(\$response);";
		}
		
		$class .= "
	}
	";
	}
	
	$class .= "
}
";

	$requires = implode("\n", $requires);
	$php = "<?php

require_once(__DIR__ . '/../GitHubClient.php');
$requires
	
$class
";

	file_put_contents(__DIR__ . "/client/services/GitHub$name.php", $php);

	if(isset($classTree[$classPath]))
	{	
		foreach($classTree[$classPath] as $file => $className)
			generateGithubService($file, $className);
	}
}

function generateGithubObject($className, array $attributes, $extends = null)
{
	echo "Generating object: $className\n";
	if(is_null($extends))
		$extends = 'GitHubObject';
		
	$requires = array();
	$class = "
class $className extends GitHubObject
{
	/* (non-PHPdoc)
	 * @see GitHubObject::getAttributes()
	 */
	protected function getAttributes()
	{
		
	}
	";
	
	foreach($attributes as $attributeName => $attributeType)
	{
		if(preg_match('/^GitHub/', $attributeType))
			$requires[$attributeType] = "require_once(__DIR__ . '/$attributeType.php');";
			
		$class .= "
	/**
	 * @var $attributeType
	 */
	protected \$$attributeName;
";
	}
	
	foreach($attributes as $attributeName => $attributeType)
	{
		$getterName = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($attributeName))));
		
		if(preg_match('/^GitHub/', $attributeType))
			$requires[$attributeType] = "require_once(__DIR__ . '/$attributeType.php');";
			
		$class .= "
	/**
	 * @return $attributeType
	 */
	public function $getterName()
	{
		return \$this->$attributeName;
	}
";
	}
	
	$class .= "
}
";
	
	$requires = implode("\n", $requires);
	$php = "<?php

require_once(__DIR__ . '/../$extends.php');
$requires
	
$class
";

	file_put_contents(__DIR__ . "/client/objects/$className.php", $php);
}

function gitHubClassName($baseName)
{
	return 'GitHub' . str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($baseName))));
}

function parseAttributes($resourceName, $resource, $indent = '      ')
{
	$attributes = array();
	
	$matches = null;
	if(preg_match_all('/\n' . $indent . '[:"]([\w_]+)"? +=> +(.+),?/', $resource, $matches))
	{
		foreach($matches[1] as $index => $attributeName)
		{
			$value = trim($matches[2][$index], ' ,');
			if($value[0] == '{')
				continue;
				
			$type = 'string';
			if($value == 'true' || $value == 'false')
				$type = 'boolean';
			elseif(preg_match('/^\d+$/', $value))
				$type = 'int';
				
			$attributes[$attributeName] = $type;
		}
	}
	
	if(preg_match_all('/\n' . $indent . ':([\w_]+) => \{(.+)\n' . $indent . '\}/sU', $resource, $matches))
	{
		foreach($matches[1] as $index => $attributeName)
		{
			$attributeName = preg_replace('/^_/', '', $attributeName);
			$attributeResourceName = "$resourceName $attributeName";
			$attributeType = gitHubClassName($attributeResourceName);
			$attributes[$attributeName] = $attributeType;
			$attributeAttributes = parseAttributes($attributeResourceName, $matches[2][$index], "$indent  ");
			generateGithubObject($attributeType, $attributeAttributes);
		}
	}
	
	if(preg_match_all('/\n' . $indent . '"([\w_]+)" => \[\s+\{(.+)\n' . $indent . '\]/sU', $resource, $matches))
	{
		foreach($matches[1] as $index => $attributeName)
		{
			$attributeName = preg_replace('/^_/', '', $attributeName);
			$attributeResourceName = "$resourceName $attributeName";
			$attributeType = gitHubClassName($attributeResourceName);
			$attributes[$attributeName] = "array<$attributeType>";
			$attributeAttributes = parseAttributes($attributeResourceName, $matches[2][$index], "$indent  ");
			generateGithubObject($attributeType, $attributeAttributes);
		}
	}
	
	return $attributes;
}

function getObjectAttributes($resourceName, &$extends, $enableExtend = true)
{
	global $resources;
	
	$matches = null;
	if(
		!preg_match('/\n    ' . $resourceName . ' = (\{|(\w+)\.merge \\\\)(.+)\n    [^ ]/sU', $resources, $matches)
		&&
		!preg_match('/\n    ' . $resourceName . ' = ((\w+))((\.merge\([^\(]+\))+)/', $resources, $matches)
	)
	{
		throw new Exception("Cant find resource for object [$resourceName]");
	}
		
	$attributes = array();
	if($matches[2])
	{
		if($enableExtend)
			$extends = gitHubClassName($matches[2]);
		else
			$attributes = getObjectAttributes($matches[2], $extends, $enableExtend);
	}
		
	$mergeMatches = null;
	if(preg_match_all('/\.merge\((\'[^\']+\' => )?([^\)]+)\)/', $matches[3], $mergeMatches))
	{
		foreach($mergeMatches[2] as $mergeResource)
		{
			$mergeAttributesMatches = null;
			if(preg_match('/^\{(\n( +).+)\}$/s', $mergeResource, $mergeAttributesMatches))
			{
				$mergeAttributes = parseAttributes($resourceName, $mergeAttributesMatches[1], $mergeAttributesMatches[2]);
				$attributes = array_merge($attributes, $mergeAttributes);
			}
			else
			{
				echo "Merging $mergeResource into $resourceName\n";
				$attributes = array_merge($attributes, getObjectAttributes($mergeResource, $extends, false));
			}
		}
	}
	else
	{
		$attributes = array_merge($attributes, parseAttributes($resourceName, $matches[3]));
	}
	return $attributes;
}

function generateGithubObjects()
{
	global $objects;
	
	foreach($objects as $object)
	{
		$resourceName = strtoupper($object);
		$extends = null;
		$attributes = getObjectAttributes($resourceName, $extends);
		generateGithubObject(gitHubClassName($object), $attributes, $extends);
	}
}
