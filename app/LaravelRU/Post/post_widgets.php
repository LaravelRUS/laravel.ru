<?php

Widget::register('previewPost', function($post)
{
    return View::make("posts/box_preview_post", compact("post"))->render();
});