@extends('layouts.nosidebar')

@section('title')
	{{{ $post->title }}}
@stop

@section('content')

{{ breadcrumbs(['Последние посты' => route('feed'), '' => '']) }}

<h1>{{{ $post->title }}}</h1>

<div class="post_credentials">
	<span class="date">{{ $post->present()->publishedAt }}</span> <a href="{{ route('user.profile', $post->author->username) }}">{{ $post->author->username }}</a>
	@if(allowEditPost($post))
		<span class="controls"><a class="btn btn-default btn-xs" href="{{ route('post.edit', $post->slug) }}">Редактировать</a></span>
	@endif
</div>

<div class="post_content">
	{{ $post->present()->textMD }}
</div>
<div class="comment_containeer">
	@if(count($post->comments))
		@include('comment.comments')
	@endif
	@include('comment.form')
</div>
@stop


