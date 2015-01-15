<?php

function translateStatus($page)
{
	if ($page->original_commits_ahead == 0)
	{
		$status = 'status-green';
	}
	elseif ($page->original_commits_ahead > 0 && $page->original_commits_agead < 3)
	{
		$status = 'status-orange';
	}
	else
	{
		$status = 'status-red';
	}

	return $status;
}