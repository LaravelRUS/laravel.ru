<?php /** @var \App\Models\Article $article */ ?>

<a href="{{ route('article', ['slug' => $article->slug]) }}" title="{{ $article->capitalize_title }}">
    <img class="article-image" src="{{ $article->image_url }}" alt="{{ $article->title }}" />
</a>

<div class="article-description">
    <div class="article-tags">
        @foreach($article->tags as $i => $tag)
            @if ($i >= (isset($isMain) && $isMain ? 5 : 3)) @break @endif

            <a href="{{ route('tag', ['id' => $tag]) }}" class="article-tag"
               style="color: {{ $tag->color }}">{{ $tag->name }}</a>
        @endforeach
    </div>


    <h3>
        <a href="{{ route('article', ['slug' => $article->slug]) }}">
            {{ $article->capitalize_title }}
        </a>
    </h3>

    <span class="article-author">
        {{ $article->user->name }}
    </span>

    <time class="article-time" datetime="{{ $article->published_at->toRfc3339String() }}">
        {{ $article->nice_published_date }}
    </time>

    @if (isset($withContent) && $withContent)
        <div class="article-content">
            <hr />
            <br />

            {!! $article->content_rendered !!}
        </div>
    @endif
</div>
