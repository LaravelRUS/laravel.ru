@extends('layouts.nosidebar')

@section('title')
	{{{ $article->title }}}
@stop

@section('content')

{{--{{ breadcrumbs(['Последние посты' => route('feed'), '' => '']) }}--}}

<h1>{{{ $article->title }}}</h1>

<div class="article_credentials">
	<span class="date">{{ $article->present()->publishedAt }}</span> <a href="{{ route('user.profile', $article->author->username) }}">{{ $article->author->username }}</a>
	@if(allowEditArticle($article))
		<span class="controls"><a class="btn btn-default btn-xs" href="{{ route('articles.edit', $article->slug) }}">Редактировать</a></span>
	@endif
</div>

<div class="article_content">
	{{ $article->present()->textMD }}
</div>
<div class="comment_containeer">
	@if(count($article->comments))
		@include('comment.comments')
	@endif

	@if( ! $article->is_comments_disabled)
		@include('comment.form')
	@endif
</div>
@stop


