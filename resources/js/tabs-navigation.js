$(document).ready(function () {
	$('main').on('click', '.tabs li', function () {
		var currentElement = $(this),
			connectedContents = currentElement.parent().siblings('ul.tab-contents');

		if (!currentElement.hasClass('active')) {
			currentElement.parent().find('li').removeClass('active');
			currentElement.addClass('active');
			setTimeout(function () {
				connectedContents.find('li').removeClass('visible');
				connectedContents.find('li[data-tab=' + currentElement.data('tab') + ']').addClass('visible');
			}, 600);
		}
	});
});