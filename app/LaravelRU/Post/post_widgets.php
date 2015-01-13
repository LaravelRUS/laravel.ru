<?php

Widget::register('previewPost', function ($post)
{
	return View::make('post/box_post', compact('post'))->render();
});
