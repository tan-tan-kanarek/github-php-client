---
GitHub API PHP Client
---


See [full API reference](https://github.com/tan-tan-kanarek/github-php-client/blob/master/client.md "full API reference")


## Authenticating

    <?php
    require_once(__DIR__ . '/client/GitHubClient.php');
    
    $client = new GitHubClient();
	$client->setCredentials($username, $password);


## Listing commits

    <?php
    require_once(__DIR__ . '/client/GitHubClient.php');
    
	$owner = 'tan-tan-kanarek';
	$repo = 'github-php-client';
	
    $client = new GitHubClient();
    $client->setPage();
    $client->setPageSize(2);
    $commits = $client->repos->commits->listCommitsOnRepository($owner, $repo);
    
    echo "Count: " . count($commits) . "\n";
    foreach($commits as $commit)
    {
        /* @var $commit GitHubCommit */
        echo get_class($commit) . " - Sha: " . $commit->getSha() . "\n";
    }
    
    $commits = $client->getNextPage();
    
    echo "Count: " . count($commits) . "\n";
    foreach($commits as $commit)
    {
        /* @var $commit GitHubCommit */
        echo get_class($commit) . " - Sha: " . $commit->getSha() . "\n";
    }

## Listing issues

    <?php
	require_once(__DIR__ . '/client/GitHubClient.php');
	
	$owner = 'tan-tan-kanarek';
	$repo = 'github-php-client';
	
	$client = new GitHubClient();
	
	$client->setPage();
	$client->setPageSize(2);
	$issues = $client->issues->listIssues($owner, $repo);
	
	foreach($issues as $issue)
	{
		/* @var $issue GitHubIssue */
		echo get_class($issue) . "[" . $issue->getNumber() . "]: " . $issue->getTitle() . "\n";
	}    

[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/ivanfemia/github-php-client/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

