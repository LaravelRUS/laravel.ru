$(document).ready(function () {
	var aceElement = $('#ace');
	if (aceElement.length) {
		var editor = ace.edit('ace');
		var btn = document.getElementById('fullScreen');

		editor.setTheme('ace/theme/github');
		editor.getSession().setMode('ace/mode/markdown');
		editor.getSession().setTabSize(4);
		editor.getSession().setUseSoftTabs(false);
		editor.getSession().setUseWrapMode(true);
		editor.setHighlightActiveLine(false);
		editor.setShowPrintMargin(false);

		aceElement.closest('form').submit(function (event) {
			var code = editor.getValue();
			console.log(code);
			aceElement.prev('input[type=hidden]').val(code);
		});

		var enterFullScreen = function () {
			btn.innerText = [btn.dataset.text, btn.dataset.text = btn.innerText][0];
			document.body.classList.toggle('fullScreen');
			editor.resize();
			editor.focus();
		};

		btn.addEventListener('click', enterFullScreen);

		editor.container.addEventListener('keydown', function (e) {
			var fullScreen = document.body.classList.contains('fullScreen');
			if (e.which == 27 && fullScreen) {
				e.preventDefault();
				return enterFullScreen();
			}

			if (e.which == 13 && e.ctrlKey && !fullScreen) {
				e.preventDefault();
				return enterFullScreen();
			}
		});
	}
});
