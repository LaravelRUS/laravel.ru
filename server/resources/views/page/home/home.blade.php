@extends('layout.master')

@push('header')

@endpush

@push('title', 'Добро пожаловать &mdash; ')

@section('content')
    <section class="welcome">
        <img src="/img/welcome/developer.png" alt="preview" />
        <aside class="welcome-about">
            <h1>Laravel — php-фреймворк нового поколения</h1>
            <span class="welcome-description">
                Мы верим, что процесс разработки только тогда наиболее
                продуктивен, когда работа с фреймворком приносит
                радость и удовольствие. Счастливые разработчики пишут лучший код.
            </span>
        </aside>
    </section>


    <main class="articles">

    </main>
@stop
