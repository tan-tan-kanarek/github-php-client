<?php
require_once "vendor/autoload.php";

use Github\Client\GitHubClient;

$repos = array(
		'server',
		'installer',
);

$client = new GitHubClient();

foreach($repos as $repo) {
	$client->setPage();
	$client->setPageSize(2);
	$commits = $client->repos->commits->listCommitsOnRepository('kaltura', $repo);

	echo "Count: " . count($commits) . "\n";
	foreach ($commits as $commit) {
		/* @var $commit GitHubCommit */
		echo get_class($commit) . " - Sha: " . $commit->getSha() . "\n";
	}

	$commits = $client->getNextPage();

	echo "Count: " . count($commits) . "\n";
	foreach ($commits as $commit) {
		/* @var $commit GitHubCommit */
		echo get_class($commit) . " - Sha: " . $commit->getSha() . "\n";
	}
}
