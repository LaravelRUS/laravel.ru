<?php

Form::macro("check", function($name, $value = 1, $checked = null, $options = array()){
    return Form::hidden($name, 0).Form::checkbox($name, $value, $checked, $options);
});


// begin http://laravelsnippets.com/snippets/bootstrap-3-form-macros

Form::macro('textField', function($name, $label = null, $desc = null, $value = null, $attributes = array())
{
    if($value===null){
        $value = Input::old($name);
    }
    $element = Form::text($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $desc, $element);
});

Form::macro('passwordField', function($name, $label = null, $desc = null, $attributes = array())
{
    $element = Form::password($name, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $desc, $element);
});

Form::macro('textareaField', function($name, $label = null, $desc = null, $value = null, $attributes = array())
{
    $element = Form::textarea($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $desc, $element);
});

Form::macro('selectField', function($name, $label = null, $desc = null, $options, $value = null, $attributes = array())
{
    $element = Form::select($name, $options, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $desc, $element);
});

Form::macro('selectMultipleField', function($name, $label = null, $desc, $options, $value = null, $attributes = array())
{
    $attributes = array_merge($attributes, ['multiple' => true]);
    $element = Form::select($name, $options, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $label, $desc, $element);
});

Form::macro('checkboxField', function($name, $label = null, $desc = null, $checked = null, $attributes = array())
{
    $value = 1;
    $attributes = array_merge(['id' => 'id-field-' . $name], $attributes);

    $out = '<div class="checkbox';
    $out .= classError($name) . '">';
    $out .= '<label>';
    $out .= Form::check($name, $value, $checked, $attributes) . ' ' . $label;
    $out .= fieldError($name);
    $out .= fieldDesc($desc);
    $out .= '</div>';
    return $out;
});

Form::macro("datetimepicker", function($name, $label = null, $desc = null, $display_value = null, $value = null, $attributes = array()){
    $out = "";
    $mirror_id = 'id-datetimemirror-'.$name;
    $out .= "<input type='hidden' name='$name' value='$value' id='$mirror_id'>";
    $picker_id = 'id-datetimepicker-'.$name;
    $attributes = array_merge($attributes, ["id"=>$picker_id,"readonly"=>"", "size"=>16]);
    $out .= initialize_datetimepicker_by_id($picker_id, $mirror_id);
    $element = Form::text("", $value, fieldAttributes($name, $attributes));
    $out .= datetimepickerWrapper($name, $label, $desc, $element, $picker_id);
    /*
	$out .= '<div class="form-group';
	$out .= classError($name) . '">';
	$out .= fieldLabel($name, $label);
	$out .= "<div class='input-append date form_datetime'><input size='16' type='text' value='' readonly><span class='add-on'><i class='icon-th'></i></span>
</div>";
	$out .= fieldError($name);
	$out .= fieldDesc($desc);
	$out .= '</div>';
	*/
    return $out;
});

function fieldWrapper($name, $label, $desc, $element)
{
    $out = '<div class="form-group';
    $out .= classError($name) . '">';
    $out .= fieldLabel($name, $label);
    $out .= $element;
    $out .= fieldError($name);
    $out .= fieldDesc($desc);
    $out .= '</div>';

    return $out;
}

function datetimepickerWrapper($name, $label, $desc, $element, $picker_id)
{
    $out = '<div class="form-group';
    $out .= classError($name) . '">';
    $out .= fieldLabel($name, $label);
    //$out .= "<div class='input-group' id='$picker_id'>";
    $out .= $element;
    //$out .= "<span class='input-group-addon'><i class='glyphicon glyphicon-th-large'></i></span></div>";
    $out .= fieldError($name);
    $out .= fieldDesc($desc);
    $out .= '</div>';

    return $out;
}

function classError($field)
{
    $error = '';

    if ($errors = Session::get('errors'))
    {
        $error = $errors->first($field) ? ' has-error' : '';
    }

    return $error;
}
function fieldError($field)
{
    $error = '';

    if ($errors = Session::get('errors'))
    {
        $error = '<span class=\'text-danger\'>'.$errors->first($field).'</span>';
    }

    return $error;
}

function fieldLabel($name, $label)
{
    if (is_null($label)) return '';

    $name = str_replace('[]', '', $name);

    $out = '<label for="id-field-' . $name . '" class="control-label">';
    $out .= $label . '</label>';

    return $out;
}

function fieldDesc($desc){
    if($desc){
        return "<div class='text-muted'>$desc</div>";
    }
}

function fieldAttributes($name, $attributes = array())
{
    $name = str_replace('[]', '', $name);

    return array_merge(['class' => 'form-control', 'id' => 'id-field-' . $name], $attributes);
}

// end http://laravelsnippets.com/snippets/bootstrap-3-form-macros