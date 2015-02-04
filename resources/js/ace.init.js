$(document).ready(function () {
	var aceElement = $('#ace');
	if (aceElement.length) {
		var editor = ace.edit("ace");
		editor.setTheme("ace/theme/twilight");
		editor.getSession().setMode("ace/mode/markdown");
		editor.getSession().setUseSoftTabs(false);
		editor.getSession().setUseWrapMode(true);

		aceElement.closest('form').submit(function (event) {
			var code = editor.getValue();
			console.log(code);
			aceElement.prev('input[type=hidden]').val(code);
		});
	}
});