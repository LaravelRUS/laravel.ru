NProgress.configure({ showSpinner: false });

$(document)
	.on('ajaxSend', function () {
		NProgress.start();
	}).on('ajaxComplete ajaxStop', function () {
		NProgress.done(true);
	});

$('form.ajax').submit(function (event) {
	event.preventDefault();
	var form = this,
		$form = $(form);

	$.ajax({
		url: $form.attr('action'),
		data: $form.serialize(),
		method: 'post',
		success: function (data) {
			if (data.success) {
				if ($form.hasClass('reset')) form.reset();

				sweetAlert({
					title: data.title || data.message,
					type: 'success'
				}, function () {
					if (data.redirect) window.location.href = data.redirect;
				});
			}

			if (data.error) {
				if (data.errors) {
					for (key in data.errors) {
						if (data.errors.hasOwnProperty(key)) {
							var input = $form.find('input[name="' + key + '"]');
							input.parent().addClass('has-error');
							$('<p class="error-block">' + data.errors[key].join('<br/>') + '</p>').insertAfter(input);
						}
					}
				}

				$form.find('button[type="submit"]').prop('disabled', false);
			}
		},
		beforeSend: function () {
			var inputElements = $form.find('.form-group');
			$form.find('button[type="submit"]').prop('disabled', true);
			$.each(inputElements, function (i, val) {
				if ($(val).hasClass('has-error')) {
					$(val).removeClass('has-error');
					$(val).find('.error-block').remove();
				}
			});
		}
	});
});
