$(document).ready(function () {
	var btnChange = document.getElementsByClassName('changeAvatar')[0];
	var btnDelete = document.getElementsByClassName('deleteAvatar')[0];
	if (!btnChange) return false;

	$(btnChange).fileapi({
		url: '/settings/avatar',
		accept: 'image/*',
		multiple: false,
		maxSize: 1 * FileAPI.MB,
		autoUpload: true,
		onSelect: function (evt, data) {
			if (data.other.length) {
				// errors
				var errors = data.other[0].errors;
				if (errors && errors.maxSize) {
					sweetAlert({
						title: 'Максимально допустимый размер фото 1024 Кб',
						type: 'warning'
					});
				}
			}
		},
		onComplete: function (evt, uiEvt) {
			var result = uiEvt.result;
			if (result.success) {
				btnDelete.classList.remove('hidden');
				btnChange.previousElementSibling.src = result.avatar + '?' + Date.now();
				sweetAlert({
					title: result.message,
					type: 'success'
				});
			} else if (result.error && result.errors) {
				sweetAlert({
					title: result.errors.avatar[0],
					type: 'error'
				});
			}
		}
	});

	btnDelete.addEventListener('click', function (e) {
		e.preventDefault();

		swal({
			title: 'Удалить Ваше фото?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Да',
			cancelButtonText: 'Нет',
			closeOnConfirm: false
		}, function () {
			$.ajax({
				url: '/settings/avatar-delete',
				type: 'delete',
				success: function (data) {
					if (data.success) {
						btnDelete.classList.add('hidden');
						btnChange.previousElementSibling.src = data.avatar + '?' + Date.now();
						sweetAlert({
							title: data.message,
							type: 'success'
						});
					}
				}
			});
		});
	});

});
