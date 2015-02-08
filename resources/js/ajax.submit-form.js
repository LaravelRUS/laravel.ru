$('form.ajax').submit(function (event) {
	event.preventDefault();
	var form = $(this);
	$.ajax({
		url: form.attr('action'),
		data: form.serialize(),
		method: 'post',
		success: function (data) {
			if (data.success && data.redirect) {
				sweetAlert({
					title: data.title,
					type: 'success'
				}, function () {
					window.location.href = data.redirect;
				});
			} else if (data.success) {
				sweetAlert({
					title: data.title,
					type: 'success'
				});
			}
			if (data.error) {
				if (data.errors) {
					for (key in data.errors) {
						if (data.errors.hasOwnProperty(key)) {
							var input = form.find('input[name="' + key + '"]');
							input.parent().addClass('has-error');
							$('<p class="error-block">' + data.errors[key] + '</p>').insertAfter(input);
						}
					}
				}
			}
		},
		beforeSend: function () {
			var inputElements = form.find('.form-group');
			$.each(inputElements, function (i, val) {
				if ($(val).hasClass('has-error')) {
					$(val).removeClass('has-error');
					$(val).find('.error-block').remove();
				}
			});
		}
	});
});