@extends('layouts.nosidebar')

@section('title')
Редактирование профиля
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Редактирование профиля</h1>
    </div>
</div>
<form action="{{ route('user.edit') }}" method="POST" role="form" onsubmit="profile.save(this);return false;">
<div class="row">
    <div class="col-md-4">
            <legend>Основные данные</legend>
            <div class="form-group">
                <label for="fullname">Имя</label>
                <input type="text" class="form-control" name="fullname" id="fullname" value="{{ $user->fullname }}">
            </div>

            <div class="form-group">
                <label for="username">Логин</label>
                <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email"  value="{{ $user->email }}">
            </div>
    </div>

    <div class="col-md-4">
            <legend>Социальные сети</legend>

            @foreach(trans('social') as $id => $name)
            <div class="form-group">
                <label for="{{ $id }}">{{ $name  }}</label>
                <input type="text" class="form-control" name="social_{{ $id }}" id="{{ $id }}" value="{{ $user->social->{$id} }}">
            </div>
            @endforeach
    </div>

    <div class="col-md-4">
            <legend>Дополнительная информация</legend>

            @foreach(trans('user_info') as $id => $name)
            <div class="form-group">
                <label for="{{ $id }}">{{ $name  }}</label>
                @if($id == 'about')
                <textarea class="form-control" name="info_{{ $id }}" id="{{ $id }}" cols="30" rows="10">{{ $user->info->{$id} }}</textarea>
                @else
                <input type="text" class="form-control" name="info_{{ $id }}" id="{{ $id }}" value="{{ $user->info->{$id} }}">
                @endif
            </div>
            @endforeach
    </div>
</div>
    <div class="msg alert" style="display:none"></div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

<script>
(function (window) { 'use strict';

    var Profile = function () {

        function save(form) {
            var $form = $(form),
                msg = $form.find('.msg'),
                id;

            $.ajax({
                url: form.action,
                data: $form.serialize(),
                method: 'post',
                success: function (data) {
                    if (data.success && data.redirect) {
                        window.location.href = data.redirect;
	                    return;
                    }

                    if (data.error) {
                        msg.addClass('alert-error');

                        if (data.errors) {
                            for (id in data.errors) {
                                if (data.errors.hasOwnProperty(id)) {
                                    $('<div class="error">' + data.errors[id].join('<br>') + '</div>')
                                            .insertAfter($form.find('[name="' + id + '"]'));
                                }
                            }
                        }
                    }

                    if (data.success) {
                        if (data.data) {
                            for (id in data.data) {
                                if (data.data.hasOwnProperty(id)) {
                                    $form.find('[name="' + id + '"]').val(data.data[id]);
                                }
                            }
                        }

                        msg.addClass('alert-success');
                        setTimeout(function () {
                            msg.fadeOut(200, function () { msg.hide() });
                        }, 3000);
                    }

                    data.message && msg.html(data.message).fadeIn(100);
                },
                beforeSend: function () {
                    $form.find('.error').remove();
                    msg.removeClass('alert-error alert-success').html('').hide();
                }
            });
        }

        return {
            save: save
        }
    };

    window.profile = new Profile;
})(window);
</script>
<style scoped="">
.error {
    color: #F00;
    font-size: 1.2rem;
    font-weight: bold;
}
</style>
@stop
