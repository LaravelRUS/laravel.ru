<?php

Widget::register('previewPackage', function ($package)
{
	return View::make('package/box_package', compact('package'))->render();
});
