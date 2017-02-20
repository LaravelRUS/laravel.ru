@extends('layout.master')

@push('header')
    @include('partials.welcome')
@endpush

@push('title', 'Добро пожаловать &mdash; ')

@section('content')
    <main class="home-page">
        <section class="articles">

            <div class="container-12">
                <h2 class="articles-title">Последние новости</h2>

                @foreach($articles as $i => $article)
                    <div class="grid-{{ $i === 0 ? '12' : ( $i === 4 ? '8' : '4' ) }}">
                        @include('page.home.partials.article', [ 'article' => $article ])
                    </div>

                    @if ($i === 4)
                        <div class="grid-4">
                            <aside class="subscribe">
                                <h2 class="subscribe-title">Получать обновления?</h2>

                                @if (Auth::check())
                                    <input type="text" placeholder="E-mail"
                                           disabled="disabled" value="{{ Auth::user()->email }}" />
                                @else
                                    <input type="text" placeholder="E-mail" />
                                @endif

                                <div class="description">
                                    Присоединяйтесь к еженедельной рассылке и
                                    не пропускайте новые советы,
                                    учебные пособия и многое другое.
                                </div>

                                <a href="#" class="button">Подписаться</a>
                            </aside>
                        </div>
                    @endif
                @endforeach

                <footer class="grid-12">
                    <a href="{{ route('articles') }}" class="button main icon-show-more">
                        @if ($articlesCount > 11)
                            Ещё {{ $articlesCount }} {{ trans_choice('публикация|публикации|публикаций', $articlesCount) }}
                        @else
                            Все новости
                        @endif
                    </a>
                </footer>
            </div>

        </section>
    </main>
@stop