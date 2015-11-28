# GitHub API PHP Client

See [full API reference](https://github.com/tan-tan-kanarek/github-php-client/blob/master/client.md "full API reference")

## Authenticating

```php
<?php
require_once "vendor/autoload.php";
use Github\Client\GitHubClient;

$client = new GitHubClient();
$client->setCredentials($login, $password);
```

## Listing commits

```php
<?php
require_once "vendor/autoload.php";
use Github\Client\GitHubClient;

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
```

## Listing issues

```php
<?php
require_once "vendor/autoload.php";
use Github\Client\GitHubClient;

$owner = 'tan-tan-kanarek';
$repo = 'github-php-client';

$client = new GitHubClient();

$client->setPage();
$client->setPageSize(2);
$issues = $client->issues->listIssues($owner, $repo);

foreach ($issues as $issue)
{
    /* @var $issue GitHubIssue */
    echo get_class($issue) . "[" . $issue->getNumber() . "]: " . $issue->getTitle() . "\n";
}
```

## Creating issues

```php
<?php
require_once "vendor/autoload.php";
use Github\Client\GitHubClient;

$owner = 'tan-tan-kanarek';
$repo = 'github-php-client';
$title = 'Something is broken.'
$body = 'Please fix it.'.

$client = new GitHubClient();
$client->setCredentials($username, $password);
$client->issues->createAnIssue($owner, $repo, $title, $body);
```

## Creating a release

```php
<?php
require_once "vendor/autoload.php";
use Github\Client\GitHubClient;

$owner = 'tan-tan-kanarek';
$repo = 'github-php-client';
$username = 'tan-tan-kanarek';
$password = 'myPassword';

$tag_name = 'myTag';
$target_commitish = 'master';
$name = 'myReleaseName';
$body = 'My release description';
$draft = false;
$prerelease = true;

$client = new GitHubClient();
$client->setDebug(true);
$client->setCredentials($username, $password);

$release = $client->repos->releases->create($owner, $repo, $tag_name, $target_commitish, $name, $body, $draft, $prerelease);
/* @var $release GitHubReposRelease */
$releaseId = $release->getId();

$filePath = 'C:\myPath\bin\myFile.jar';
$contentType = 'application/java-archive';
$name = 'MyFile-1.0.0.jar';

$client->repos->releases->assets->upload($owner, $repo, $releaseId, $name, $contentType, $filePath);
```
*[11/28/2015] Refactor to work with composer autoload
*[8/06/2015] Fixed pull request comment function


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/ivanfemia/github-php-client/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
