<?

exit('Only to be used as an helper for your IDE');

class Form{

	static public function textField($name, $label = null, $desc = null, $value = null, $attributes = array()){
		return "string";
	}
	static public function textareaField($name, $label = null, $desc = null, $value = null, $attributes = array()){
		return "string";
	}
	static public function selectField($name, $label = null, $desc = null, $options, $value = null, $attributes = array()){
		return "string";
	}
	static public function selectMultipleField($name, $label = null, $desc = null, $options, $value = null, $attributes = array()){
		return "string";
	}
	static public function checkboxField($name, $label = null, $desc = null, $value = 1, $checked = null, $attributes = array()){
		return "string";
	}

}