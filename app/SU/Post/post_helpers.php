<?php
/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------

*/

function allow_edit_post($post_id)
{
	$access = App::make('SU\Post\Access\PostAccess');
	try{
		$access->checkEditPost($post_id);
	}catch(Symfony\Component\Security\Core\Exception\AccessDeniedException $e){
		return false;
	}
	return true;
}

