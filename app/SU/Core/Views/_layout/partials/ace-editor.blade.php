<script src="/vendor/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
	$(document).ready(function() {
		var editor = ace.edit("ace-editor");
		editor.setTheme("ace/theme/twilight");
		editor.getSession().setMode("ace/mode/php");
	});
</script>
