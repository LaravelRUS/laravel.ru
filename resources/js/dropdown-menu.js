$(document).ready(function () {
	$('body').on('click', '[data-toggle=dropdown]', function () {
		$(this).siblings('ul.dropdown').toggleClass('visible');
	});
});