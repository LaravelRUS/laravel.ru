@extends('layout.master')

@push('body-class') bg-gray @endpush

@section('content')
    <?php /** @var \App\Models\Article $article */ ?>

    <section class="container-12">
        <div class="article-show grid-12">

            <article class="article">
                <figure>
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" />
                </figure>

                <h2>{{ $article->capitalize_title }}</h2>

                <hr />

                <div class="article-content">
                    {!! $article->content_rendered !!}
                </div>
            </article>

            <footer>
                <div class="article-author">
                    <img src="{{ $article->user->avatar }}" alt="{{ $article->user->name }}" />

                    <span>{{ $article->user->name }}</span>
                </div>

                <time class="article-time" datetime="{{ $article->published_at->toRfc3339String() }}">
                    {{ $article->nice_published_date }}
                </time>
            </footer>
        </div>
    </section>
@stop