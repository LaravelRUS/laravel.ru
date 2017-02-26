<?php /** @var \App\Models\Article $article */ ?>

<article class="article">
    <a class="image" href="{{ route('articles.show', ['slug' => $article->slug]) }}"
       title="{{ $article->capitalize_title }}">
        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" />
    </a>

    <div class="description">
        <a href="{{ route('articles.show', ['slug' => $article->slug]) }}" class="title">
            <h3>{{ $article->capitalize_title }}</h3>
        </a>

        <span class="author">
            {{ $article->user->name }}
        </span>

        <time class="time" datetime="{{ $article->published_at->toRfc3339String() }}">
            {{ $article->nice_published_date }}
        </time>
    </div>
</article>