<?php

Widget::register("news", function($news){
    return View::make("news/box_news", compact("news"))->render();
});