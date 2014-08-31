This is example view for module Post.<br>
Created by laravel-modulator.<br>
<br>
<h4>Example for form validation</h4>
<form action="" method="POST">

Field1: <?php echo Form::text('field1', Input::old('field1')); ?><br>
<?php if($errors->first('field1')) echo '<span style="color:red">'.$errors->first('field1').'</span>'; ?>

Field2: <?php echo Form::text('field2', Input::old('field2')); ?><br>
<?php if($errors->first('field2')) echo '<span style="color:red">'.$errors->first('field2').'</span>'; ?>

<input type="submit">

</form>

<?php if(isset($success)){ echo "Validation passed."; } ?>
