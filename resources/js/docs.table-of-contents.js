$(document).ready(function () {
	$('.subnav').on('click', '.docs-menu-button', function () {
		$('.docs .sidebar').toggleClass('visible');
	});
});