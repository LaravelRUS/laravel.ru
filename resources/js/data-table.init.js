$(document).ready(function () {
	var dataTable = $('.data-table');
	if (dataTable.length) {
		dataTable.DataTable({
			ajax: {
				url: window.location.href
			},
			columns: [{
					data: 'id'
				},{
					data: 'title'
				},{
					data: 'created_at'
				},{
					data: 'updated_at'
				},{
					data: 'id',
					render: function (id) {
						return '<a href="#" onclick="Admin.editEntity('+id+');return false">Edit</a>' +
							'<a href="#" onclick="Admin.destroyEntity('+id+');return false">Delete</a>';
					}
				}
			]
		});
	}
});
Admin = {};
Admin.editEntity = function (id) {
	window.location.pathname += '/' + id + '/edit';
};
Admin.destroyEntity = function (id) {
	if (!confirm('Delete?')) return false;

	$.ajax({
		url: window.location.pathname + '/' + id,
		type: 'delete'
	});
};
