<?php

function translationStatus($page)
{
	if ($page->original_commits_ahead == 0)
	{
		$status = 'status-green';
	}
	elseif ($page->original_commits_ahead > 0 && $page->original_commits_ahead < 3)
	{
		$status = 'status-yellow';
	}
	else
	{
		$status = 'status-red';
	}

	return $status;
}
