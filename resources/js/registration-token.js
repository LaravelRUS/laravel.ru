$(document).ready(function () {
	$('form.register input[name="jsToken"]').val(function () {
		return $(this).data('token');
	});
});