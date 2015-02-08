$(document).ready(function () {
	var dataTable = $('.data-table');
	if (dataTable.length) {
		dataTable.DataTable({
			ajax: {
				url: window.location.href
			},
			columns: [
				{"data": "id"}
			]
		});
	}
});