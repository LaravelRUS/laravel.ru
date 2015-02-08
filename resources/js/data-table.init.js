$(document).ready(function () {
	var dataTable = $('.data-table');
	if (dataTable.length) {
		dataTable.DataTable({
			ajax: {
				url: window.location.href
			},
			columns: [{
				data: 'id'
			}, {
				data: 'title'
			}, {
				data: 'created_at'
			}, {
				data: 'updated_at'
			}, {
				data: 'id',
				render: function (id) {
					return '<a href="#" onclick="Admin.editEntity(' + id + ');return false">Edit</a>' +
						'<a href="#" onclick="Admin.destroyEntity(' + id + ');return false">Delete</a>';
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
	swal({
		title: 'Are you sure?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, delete it!',
		closeOnConfirm: false
	}, function () {
		$.ajax({
			url: window.location.pathname + '/' + id,
			type: 'delete',
			success: function (data) {
				if (data.success) {
					sweetAlert({
						title: data.message,
						type: 'success'
					}, function () {
						$('.data-table').DataTable().ajax.reload()
					});
				} else if (data.error) {
					sweetAlert({
						title: data.message,
						type: 'error'
					});
				}
			}
		});
	});
};
