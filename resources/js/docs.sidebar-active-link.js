$(document).ready(function () {
	if ($('.docs').length) {
		var activeLink = window.location.pathname,
			sidebarElement = $('a[href="' + activeLink + '"]');

		if (sidebarElement) {
			sidebarElement.closest('li').addClass('active');
		}
	}
});