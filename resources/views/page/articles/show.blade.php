@extends('layout.master')

@push('body-class', 'bg-gray')

@push('title', $article->capitalize_title . ' &mdash; ')

@section('content')
    <?php /** @var \App\Models\Article $article */ ?>

    <section class="container-12" data-vm="ArticleShowViewModel">
        <div class="article-show grid-12" itemscope itemtype="http://schema.org/Article">
            <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage"
                  itemid="{{ url()->current() }}"/>

            <article class="article">
                <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <img style="display: none" class="hidden"
                         itemprop="contentUrl" src="{{ $article->image_url }}"
                         alt="{{ $article->title }}" />

                    <img itemprop="url" src="{{ $article->image_url }}" alt="{{ $article->title }}" />
                    <meta itemprop="width" content="1000" />
                    <meta itemprop="height" content="500" />
                </figure>

                <time class="article-time" datetime="{{ $article->published_at->toRfc3339String() }}">
                    {{ $article->nice_published_date }}

                    <meta itemprop="dateModified" content="{{ $article->updated_at->toRfc3339String() }}" />
                    <meta itemprop="datePublished" content="{{ $article->published_at->toRfc3339String() }}" />
                </time>

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


                <div class="hidden" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                    <span itemprop="name">{{ config('app.name') }}</span>
                    {{-- Поддержка Яндекс.Справочника
                        <meta itemprop="address" content="#" />
                        <meta itemprop="telephone" content="#" />
                    --}}

                    <figure itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                        <img class="hidden" itemprop="contentUrl" src="/img/logo.png" alt="{{ config('app.name') }}" />
                        <img itemprop="url" src="/img/logo.png" alt="{{ config('app.name') }}" />
                        <meta itemprop="width" content="88" />
                        <meta itemprop="height" content="60" />
                    </figure>
                </div>


                <div class="article-tags">
                    @foreach($article->tags as $i => $tag)
                        @push('keywords', $tag->name . ', ')

                        @if ($i < 5)
                            <a href="#" itemprop="articleSection" class="article-tag"
                               style="background: {{ $tag->color }}">
                                {{ $tag->name }}
                            </a>
                        @else
                            <meta itemprop="articleSection" content="{{ $tag->name }}" />
                        @endif
                    @endforeach
                </div>
            </footer>
        </div>
    </section>
@stop