@extends('layout.master')

@section('content')
    <main class="login container-12" data-vm="LoginViewModel">
        <h2>Вход</h2>

        <section class="grid-6 prefix-3 suffix-3">
            <form action="{{ route('login.action') }}" method="POST">
                {!! csrf_field() !!}

                <div class="form-item">
                    <input type="text" name="login" placeholder="Логин" />
                </div>

                <div class="form-item">
                    <input type="password" name="password" placeholder="Пароль" />
                </div>

                <div class="form-item">
                    <label>
                        <input type="checkbox" name="remember" />
                        Запомнить меня
                    </label>
                </div>

                <input type="submit" value="Вход" class="button" />
            </form>

            <a href="{{ route('registration') }}" rel="nofollow">Нет аккаунта?</a>
            <a href="#" rel="nofollow">Восстановление пароля</a>
        </section>

    </main>
@stop