<?php

Widget::register('previewArticle', function($article)
{
    return View::make("article/box_article", compact("article"))->render();
});