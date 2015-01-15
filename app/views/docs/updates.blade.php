@extends('layouts.nosidebar')

@section('title')
    Апдейты документации
@stop

@section("submenu")
<div class="navbar submenu-nav">
    <div class="container">
        <div class="row">
            <ul class="nav navbar-nav navbar-right">
                @if(allowEditTerms())
		            <li class="{{ activeByRoute('terms') }}"><a href="{{ route('terms') }}">Термины</a></li>
	            @endif
                @li('Прогресс перевода', 'documentation.updates')
            </ul>
        </div>
    </div>
</div>
@stop

@section('content')
<h1>Апдейты документации</h1>

<p>Если вы хотите помочь с переводом документации, ознакомьтесь пожалуйста с этой <a href="/content/rus-documentation-contribution-guide">инструкцией</a>.</p>

@foreach($versions as $v)
<h2>Ветка <a href="https://github.com/laravel/docs/tree/{{ $v->number_alias }}">{{ $v->number_alias }}</a></h2>
<table class="table table-bordered">
    <tr>
        <th></th>
        <th>Наименование</th>
        <th>Перевод</th>
        <th>от оригинала</th>
        <th>Текущий оригинал</th>
        <th>Новые коммиты</th>
    </tr>
    @foreach($v->documents as $i => $doc)
    <tr>
        <td style="text-align: center">{{ $i+1 }}</td>
        <td>{{ $doc->name }}</td>
        <td>{{ $doc->last_commit_at->format('d.m.Y H:i') }} <span class="text-muted">{{ substr($doc->last_commit, 0, 7) }}</span></td>
        <td>{{ $doc->last_original_commit_at->format('d.m.Y H:i') }} <span class="text-muted">{{ substr($doc->last_original_commit, 0, 7) }}</span></td>
        <td>
	        <span class="text-muted">
                <a href="https://github.com/laravel/docs/blob/{{ $doc->current_original_commit }}/{{ $doc->name }}.md">{{ $doc->current_original_commit }}</a>
            </span>
        </td>
        <td>
            @if( ! $doc->original_commits_ahead)
                <span class="text-success">перевод не требуется</span>
            @else
                <span class="text-danger">{{ $doc->original_commits_ahead }}</span>
                git difftool {{ substr($doc->last_original_commit, 0, 7) }} {{ substr($doc->current_original_commit, 0, 7) }} {{ $doc->name }}.md
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endforeach
@stop
