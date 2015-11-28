<?php

require_once "vendor/autoload.php";

use Github\Client\GitHubClient;

#Authenticating

$client = new GitHubClient();
$client->setCredentials("williamokano", "15031989aA@");

#Listing commits
$owner = "williamokano";
$repo = "travis-test";

$client->setPage();
$client->setPageSize(3);

$commits = $client->repos->commits->listCommitsOnRepository($owner, $repo);
echo "Count: " . count($commits) . PHP_EOL;
foreach ($commits as $commit) {
    /** @var $commit \Github\Client\Objects\GitHubCommit */
    echo get_class($commit) . " - Sha: " . $commit->getSha() . PHP_EOL;
}

$commits = $client->getNextPage();
echo "Count page 2: " . count($commits) . PHP_EOL;
foreach ($commits as $commit) {
    /** @var \Github\Client\Objects\GitHubCommit */
    echo get_class($commit) . " - Sha: " . $commit->getSha() . PHP_EOL;
}

#Listing issues
$issues = $client->issues->listIssues($owner, $repo);
foreach ($issues as $issue)
{
    /* @var $issue \Github\Client\Objects\GitHubIssue */
    echo get_class($issue) . "[" . $issue->getNumber() . "]: " . $issue->getTitle() . "\n";
}

#Creating issues
$title = 'Something is broken.';
$body = 'Please fix it.';

//$issue = $client->issues->createAnIssue($owner, $repo, $title, $body);
//echo sprintf("Issue criada ID: %d -> Title %s", $issue->getNumber(), $issue->getTitle());

#Creating a release
$tag_name = 'myTag2';
$target_commitish = 'master';
$name = 'myReleaseName 2.0';
$body = 'My release description';
$draft = false;
$prerelease = true;

$client->setDebug(true);
$release = $client->repos->releases->create($owner, $repo, $tag_name, $target_commitish, $name, $body, $draft, $prerelease);
$releaseId = $release->getId();

$filePath = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "test.php";
$contentType = "text/plain";
$name = "MyTest.Ver{$releaseId}.php";

$client->repos->releases->assets->upload($owner, $repo, $releaseId, $name, $contentType, $filePath);
