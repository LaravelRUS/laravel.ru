@extends('layout.master')

@section('content')
    <main class="registration container-12" data-vm="RegistrationViewModel">
        <h2>Регистрация</h2>

        <form action="{{ route('registration') }}" method="POST">
            {!! csrf_field() !!}

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="text" name="name"
                       data-bind="value: name" placeholder="Ваш псевдоним" />
            </div>

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="text" name="email"
                       data-bind="value: email" placeholder="E-mail" />
            </div>

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="@{{ passwordVisible() ? 'text' : 'password' }}" name="password"
                       data-bind="value: password.original" placeholder="Пароль" />

                @{{#if passwordVisible}}
                    <span class="form-item-hide-password" title="Скрыть пароль"
                          data-bind="click: togglePasswordVisibility"></span>
                <!-- else -->
                    <span class="form-item-show-password" title="Показать пароль"
                          data-bind="click: togglePasswordVisibility"></span>
                @{{/if}}
            </div>

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="@{{ passwordVisible() ? 'text' : 'password' }}" name="password_confirmation"
                       data-bind="value: password.repeat" placeholder="Повторите пароль" />
            </div>

            <div class="form-item">
                <div class="grid-3 prefix-3">
                    <a href="{{ route('login') }}" rel="nofollow">У меня уже есть аккаунт</a>
                </div>

                <div class="grid-3 suffix-3">
                    <input type="submit" value="Создать пользователя" data-bind="click: register" class="button main"/>
                </div>
            </div>

            <div class="form-item grid-6 prefix-3 suffix-3">
                @{{#foreach errors}}
                    @{{#if visible}}
                        <div class="label error">@{{ message }}</div>
                    @{{/if}}
                @{{/foreach}}
                @foreach($errors->all() as $error)
                    <div class="label error">{{ $error }}</div>
                @endforeach
            </div>
        </form>


    </main>
@stop
