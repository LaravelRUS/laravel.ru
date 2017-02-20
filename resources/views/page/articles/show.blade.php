@extends('layout.master')

@push('body-class') bg-gray @endpush

@section('content')
    <?php /** @var \App\Models\Article $article */ ?>

    <section class="container-12" data-vm="ArticleShowViewModel">
        <div class="article-show grid-12" itemscope itemtype="http://schema.org/Article">
            <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage"
                  itemid="{{ url()->current() }}"/>

            <article class="article">
                <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <img itemprop="url" src="{{ $article->image_url }}" alt="{{ $article->title }}" />
                    <meta itemprop="width" content="1000" />
                    <meta itemprop="height" content="500" />
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
                <div class="article-author" itemprop="author" itemscope itemtype="http://schema.org/Person">
                    <img itemprop="image" src="{{ $article->user->avatar }}" alt="{{ $article->user->name }}" />

                    <span itemprop="name">{{ $article->user->name }}</span>
                </div>

                <div class="article-tags">
                    @foreach($article->tags as $i => $tag)
                        @if ($i < 5)
                            <a href="#" itemprop="articleSection" class="article-tag">{{ $tag->name }}</a>
                        @else
                            <meta itemprop="articleSection" content="{{ $tag->name }}" />
                        @endif
                    @endforeach
                </div>

                <time class="article-time" datetime="{{ $article->published_at->toRfc3339String() }}">
                    {{ $article->nice_published_date }}
                    <meta itemprop="dateModified" content="{{ $article->updated_at->toRfc3339String() }}" />
                    <meta itemprop="datePublished" content="{{ $article->published_at->toRfc3339String() }}" />
                </time>
            </footer>
        </div>
    </section>
@stop