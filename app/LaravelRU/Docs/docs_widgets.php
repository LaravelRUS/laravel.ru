<?php

Widget::register("versionSelector", function($version, $name){
    $all_versions = Config::get("laravel.versions");
    return View::make("docs/version_selector", ['all_versions'=>$all_versions, 'current_version'=>$version, 'name'=>$name])->render();
});