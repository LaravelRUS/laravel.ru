@extends('layout.master')

@section('content')
    <main class="login container-12" data-vm="LoginViewModel">
        <h2>Вход</h2>

        <form action="{{ route('login.action') }}" method="POST">
            {!! csrf_field() !!}

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="text" name="login" placeholder="Логин"/>
            </div>

            <div class="form-item grid-6 prefix-3 suffix-3">
                <input type="password" name="password" placeholder="Пароль"/>
            </div>


            <div class="form-item">
                <div class="grid-3 prefix-3">
                    <label class="checkbox">
                        <input type="checkbox" name="remember"/>
                        <span class="checkbox-bullet"></span>

                        Запомнить меня
                    </label>
                </div>

                <div class="grid-3 suffix-3">
                    <input type="submit" value="Вход" class="button main"/>
                </div>
            </div>

            <div class="login-advanced-links grid-6 prefix-3 suffix-3">
                <a href="{{ route('registration') }}" rel="nofollow">Нет аккаунта?</a>

                <a href="#" rel="nofollow">Восстановление пароля</a>
            </div>
        </form>


    </main>
@stop