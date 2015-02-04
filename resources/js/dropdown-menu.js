$(document).ready(function () {
	$('body').on('click', '[data-toggle=dropdown]', function () {
		$(this).closest('li').toggleClass('active');
		$(this).siblings('ul.dropdown').toggleClass('visible');
	});

	$('body').on('click', '.toggle-button', function () {
		$(this).parent().siblings('div.collapse').slideToggle("fast");
	})
});