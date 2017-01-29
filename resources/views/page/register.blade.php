@extends('layout.master')

@section('content')
    <main class="registration container-12" data-vm="RegistrationViewModel">
        <h2>Регистрация</h2>

        <form action="{{ route('registration.action') }}" method="POST">
            {!! csrf_field() !!}

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="text" name="login" placeholder="Логин"/>
            </div>

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="password" name="password" placeholder="Пароль"/>
            </div>

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="password" name="password_repeat" placeholder="Повторите пароль"/>
            </div>

            <div class="form-item">
                <div class="grid-3 prefix-3">
                    <a href="{{ route('login') }}" rel="nofollow">У меня уже есть аккаунт</a>
                </div>

                <div class="grid-3 suffix-3">
                    <input type="submit" value="Создать пользователя" class="button main"/>
                </div>
            </div>
        </form>


    </main>
@stop