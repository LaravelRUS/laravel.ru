<?php namespace LaravelRU\HTML;

use Input;
use Session;

class Element {

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

	public function password($field = 'password', $label = 'Пароль', $placeholder = null, $required = true)
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
		$element = '<input type="hidden" name="' . $field . '" value="' . $value . '">';

		return $element;
	}

	public function textarea($field, $label, $rows = 3, $placeholder = null, $value = null, $disabled = false, $disableLabel = false)
	{
		$oldInput = Input::old($field);

		if ($oldInput && $oldInput !== null)
		{
			$value = $oldInput;
		}

		$element = '<div class="form-group' . $this->errorClass($field) . '">';
		if ( ! $disableLabel)
		{
			$element .= '<label for="' . $field . '">' . $label . '</label>';
		}
		$element .= '<textarea name="' . $field . '" class="form-control" id="' . $field . '"' . $this->placeholderText($placeholder) . $this->disabledWord($disabled) . ' rows="' . $rows . '">' . $value . '</textarea>';
		$element .= $this->errorHelpBlock($field);
		$element .= '</div>';

		return $element;
	}

	public function select($field, $label, array $values, $selected = null, $nullable = false)
	{
		$oldInput = Input::old($field);

		if ($oldInput && $oldInput !== null)
		{
			$selected = $oldInput;
		}

		$element = '<div class="form-group ' . $this->errorClass($field) . '">';
		$element .= '<label for="' . $field . '">' . $label . '</label>';
		$element .= '<select name="' . $field . '" class="form-control" id="' . $field . '">';
		$element .= $nullable ? '<option value="0">- - -</option>' : null;
		foreach ($values as $key => $value)
		{
			$selectedCategory = ($selected == $key) ? 'selected="selected"' : '';
			$element .= '<option value="' . $key . '" ' . $selectedCategory . '>' . $value . '</option>';
		}
		$element .= '</select>';
		$element .= $this->errorHelpBlock($field);
		$element .= '</div>';

		return $element;
	}

	public function checkbox($field, $label, $value = null, $required = false, $disabled = false)
	{
		$checkedExpression = $this->checkForChecked($field, $value);

		$element = '<div class="form-group' . $this->errorClass($field) . '">';
		$element .= '<input type="hidden" name="' . $field . '" value="0" />';
		$element .= '<input type="checkbox" name="' . $field . '" class="form-control" value="1" id="' . $field . '"' . $checkedExpression . $this->requiredWord($required) . $this->disabledWord($disabled) . '/>';
		$element .= '<label for="' . $field . '">' . $label . '</label>';
		$element .= $this->errorHelpBlock($field);
		$element .= '</div>';

		return $element;

	}


	public function button($text, $class = 'success', $type = 'submit')
	{
		return '<button type="' . $type . '" class="' . $class . '">' . $text . '</button>';
	}

	public function ace($field, $label, $value = null)
	{
		$element = '<div class="form-group ' . $this->errorClass($field) . '">';
		$element .= '<label for="ace">' . $label . '</label>';
		$element .= '<input type="hidden" name="' . $field . '">';
		$element .= '<div id="ace">' . $value . '</div>';
		$element .= $this->errorHelpBlock($field);
		$element .= '</div>';

		return $element;
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

	/**
	 * Для чекбокса - надо ли ставить checked в форме
	 *
	 * @param $field
	 * @param $value
	 * @return string
	 */
	private function checkForChecked($field, $value)
	{
		$oldInput = Input::old($field);

		if( ! is_null($oldInput))
		{
			if($oldInput)
			{
				$checkedExpression = " checked";
			}
			else
			{
				$checkedExpression = "";
			}
		}
		else
		{
			if($value)
			{
				$checkedExpression = " checked";
			}
			else
			{
				$checkedExpression = "";
			}
		}
		return $checkedExpression;
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
		return (($errors = Session::get('errors')) && $errors->has($field)) ? '<p class="error-block">' . $errors->first($field) . '</p>' : null;
	}
}
