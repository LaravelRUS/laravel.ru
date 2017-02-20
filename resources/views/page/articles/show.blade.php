@extends('layout.master')

@push('body-class') bg-gray @endpush

@section('content')
    <?php /** @var \App\Models\Article $article */ ?>

    <section class="container-12" data-vm="ArticleShowViewModel">
        <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage"
              itemid="{{ url()->current() }}" />

        <meta itemprop="dateModified" content="{{ $article->published_at->toRfc3339String() }}" />

        <div class="article-show grid-12">
            <article class="article" itemscope itemtype="http://schema.org/Article">
                <figure itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                    <img itemprop="url" src="{{ $article->image_url }}" alt="{{ $article->title }}" />
                </figure>

                <h2 itemprop="headline">
                    {{ $article->capitalize_title }}
                </h2>

                <hr />

                <div class="article-content" itemprop="articleBody" data-bind="interpolation: false">
                    {!! $article->content_rendered !!}
                </div>
            </article>

            <footer>
                <div class="article-author" itemscope itemtype="http://schema.org/Person">
                    <img itemprop="image" src="{{ $article->user->avatar }}" alt="{{ $article->user->name }}" />

                    <span itemprop="name">{{ $article->user->name }}</span>
                </div>

                <div class="article-tags">
                    @foreach($article->tags as $i => $tag)
                        @if ($i < 5)
                            <a href="#" itemprop="articleSection" class="article-tag">{{ $tag }}</a>
                        @else
                            <meta itemprop="articleSection" content="{{ $tag }}" />
                        @endif
                    @endforeach
                </div>

                <time class="article-time" datetime="{{ $article->published_at->toRfc3339String() }}">
                    {{ $article->nice_published_date }}
                </time>
            </footer>
        </div>
    </section>
@stop