<?php

/**
 * Генерация блока breadcrubs
 * Использование: $items = ['Текст ссылки'=>'урл ссылки', ...]
 *
 * @param array $items
 * @return string
 */
function breadcrumbs($items)
{
	$last_i = count($items) - 1;
	$output = "<ol class=\"breadcrumb\">";
	$i = 0;
	foreach($items as $text=>$url){
		if($i==$last_i){
			// Последний элемент
			$output .= "<li class=\"active\">$text</li>";
		}else{
			$output .= "<li><a href=\"$url\">$text</a></li>";
		}
		$i++;
	}
	$output .= "</ol>";
	return $output;
}

/**
 * Макрос Form::check - чекбокс, который возвращает 0 в неустановленном состоянии
 */
//Form::macro("check", function($name, $value = 1, $checked = null, $options = array()){
//	return Form::hidden($name, 0).Form::checkbox($name, $value, $checked, $options);
//});