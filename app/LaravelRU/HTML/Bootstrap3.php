<?php namespace LaravelRU\HTML;

use Input;
use Session;

class Bootstrap3 {

	public function input($type = 'text', $field, $label, $placeholder = null, $value = null, $required = false, $disabled = false)
	{
		$value = $this->checkForValue($field, $value);

		$element = '<div class="form-group' . $this->errorClass($field) . '">';
		$element .= '<label for="' . $field . '">' . $label . '</label>';
		$element .= '<input type="' . $type . '" name="' . $field . '" class="form-control" id="' . $field . '"' . $this->placeholderText($placeholder) . $value . $this->requiredWord($required) . $this->disabledWord($disabled) . '>';
		$element .= $this->errorHelpBlock($field);
		$element .= '</div>';

		return $element;
	}

	public function password($field, $label, $placeholder = null, $required = true)
	{
		$element = '<div class="form-group' . $this->errorClass($field) . '">';
		$element .= '<label for="' . $field . '">' . $label . '</label>';
		$element .= '<input type="password" name="' . $field . '" class="form-control" id="' . $field . '"' . $this->placeholderText($placeholder) . $this->requiredWord($required) . '>';
		$element .= $this->errorHelpBlock($field);
		$element .= '</div>';

		return $element;
	}

	public function hidden($field, $value = null)
	{
		$element = '<input type="hidden" name="' . $field . '" id="' . $field . '" value="' . $value . '">';

		return $element;
	}

	public function button($text, $class = 'success', $type = 'submit')
	{
		return '<button type="' . $type . '" class="btn btn-' . $class . '">' . $text . '</button>';
	}

	private function checkForValue($field, $value)
	{
		$oldInput = Input::old($field);

		if ($oldInput && ! is_null($oldInput))
		{
			$value = ' value = "' . $oldInput . '"';
		}
		elseif ( ! is_null($value))
		{
			$value = ' value = "' . $value . '"';
		}
		else
		{
			$value = null;
		}

		return $value;
	}

	private function requiredWord($required)
	{
		return $required === true ? ' required' : null;
	}

	private function disabledWord($disabled)
	{
		return $disabled === true ? ' disabled' : null;
	}

	private function placeholderText($placeholder)
	{
		return ! is_null($placeholder) ? ' placeholder = "' . $placeholder . '"' : null;
	}

	private function errorClass($field)
	{
		return (($errors = Session::get('errors')) && $errors->has($field)) ? ' has-error' : null;
	}

	private function errorHelpBlock($field)
	{
		return (($errors = Session::get('errors')) && $errors->has($field)) ? '<span class="help-block">' . $errors->first($field) . '</span>' : null;
	}
}
