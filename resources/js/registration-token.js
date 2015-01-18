$(document).ready(function () {
	$('form.register input[name="jtoken"]').val(function () {
		return $(this).data('token');
	});
});