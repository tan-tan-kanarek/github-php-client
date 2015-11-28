<?php
namespace Github\Client\Services;

use Github\Client\GitHubClient;
use Github\Client\GitHubService;

class GitHubMarkdown extends GitHubService
{
	public function getTextAsMarkdown($text, $mode = 'markdown', $context = null)
	{
		$data = array(
			'text' => $text,
			'mode' => $mode
		);
		if(!is_null($context))
			$data['context'] = $context;
		
		return $this->client->request("/markdown", 'POST', json_encode($data), 200, 'string', false);
	}
}

