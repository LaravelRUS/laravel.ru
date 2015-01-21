@extends('layouts.nosidebar')

@section('title')
    Пользователь
@stop

@section('content')

<div class="row">
    <div class="col-md-4">
        <h3>{{ $user->username }}</h3>
        <p>
            <br><br>Аватар<br><br>
        </p>
        @if( $user->isAdmin() ) <span class="text-danger">Администратор</span>  @endif
        @if( $user->isModerator() ) <span class="text-danger">Модератор</span>  @endif
        <p>Зарегистрировался:</p>
        <p>Последняя активность:</p>
        <p>Статей: 3</p>
        <p>Комментариев: 354</p>
        <p>Новостей предложено: 120</p>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <p>О себе:</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>Вконтакт:</p>
                <p>Твиттер:</p>
                <p>Фейсбук:</p>
                <p>Гитхаб:</p>
                <p>Битбакет:</p>
                <p>Google Plus:</p>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</div>


<ul class="nav nav-tabs">
    <li class="active">Статьи</li>
    <li>Черновики</li>
    <li>Черновики</li>
</ul>

@stop