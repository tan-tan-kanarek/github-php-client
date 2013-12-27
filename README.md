---
GitHub API PHP Client
---

## Example

    <?php
    require_once(__DIR__ . '/client/GitHubClient.php');
    
    $client = new GitHubClient();
    $client->setPage();
    $client->setPageSize(2);
    $commits = $client->repos->commits->listCommitsOnRepository('kaltura', 'server');
    
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
    


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/ivanfemia/github-php-client/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

