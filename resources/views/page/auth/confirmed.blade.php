@extends('layout.master')

@push('title', 'Подтверждение почты &mdash; ')

@section('content')
    <main class="container-12">
        <div class="grid-6 prefix-3 suffix-3">
            <h2>Привет, {{ $user->name }}!</h2>
        </div>

        <div class="grid-6 prefix-3 suffix-3" style="text-align: center">
            <h3>Ваш E-mail &laquo;{{ $user->email }}&raquo; успешно подтверждён</h3>
        </div>

        <div class="grid-6 prefix-3 suffix-3" style="text-align: center">
            Вы будете перенаправлены на главную страницу через
            5 секунд, если этого не произошло &mdash; нажмите на кнопку.
            <br /><br /><br />

            <a class="button main" href="{{ route('home') }}">Отлично!</a>
        </div>

        <script>
            setTimeout(function() {
                document.location = '{{ route('home') }}';
            }, 5000);
        </script>
    </main>
@stop