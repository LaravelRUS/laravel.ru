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
<div class="row">
    <div class="col-md-4">
        <form action="{{ route('user.edit.main') }}" method="POST" role="form" onsubmit="profile.save(this);return false;">
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

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

    <div class="col-md-4">
        <form action="{{ route('user.edit.social') }}" method="POST" role="form" onsubmit="profile.save(this);return false;">
            <legend>Социальные сети</legend>

            @foreach(trans('social') as $id => $name)
            <div class="form-group">
                <label for="{{ $id }}">{{ $name  }}</label>
                <input type="text" class="form-control" name="social_{{ $id }}" id="{{ $id }}" value="{{ $user->social->{$id} }}">
            </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

    <div class="col-md-4">
        <form action="{{ route('user.edit.info') }}" method="POST" role="form" onsubmit="profile.save(this);return false;">
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

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>

<script>
(function (window) { 'use strict';

    var Profile = function () {

        function save(form) {
            var $form = $(form);

            $.ajax({
                url: form.action,
                data: $form.serialize(),
                method: 'post',
                success: function (res) {
                    var msg = $('<div class="alert">'+res.message+'</div>');
                    if (res.error) {
                        msg.addClass('alert-error');

                        if (res.errors) {
                            for (var id in res.errors) {
                                if (res.errors.hasOwnProperty(id)) {
                                    $form.find('[name="' + id + '"]').after('<div class="error">' + res.errors[id].join('<br>') + '</div>');
                                }
                            }
                        }
                    }

                    if (res.success) {
                        msg.addClass('alert-success');
                        setTimeout(function () {
                            msg.fadeOut(200, function () { msg.remove() });
                        }, 3000);
                    }

                    if (res.message) {
                        msg.insertAfter($form.find('legend'));
                    }
                },
                beforeSend: function () {
                    $form.find('.error').remove();
                    $form.find('.alert').remove();
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
@stop
