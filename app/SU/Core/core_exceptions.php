<?php
/**
 * Типовые реакции на эксепшны
 *
 */

use Laracasts\Validation\FormValidationException;

// Ошибка валидации формы
App::error(function(FormValidationException $e){

	if(\Request::ajax()){
		// TODO json вывод для ошибок валидации форм (если надо)
		return null;
	}else{
		return \Redirect::back()->withInput()->withErrors($e->getErrors());
	}

});