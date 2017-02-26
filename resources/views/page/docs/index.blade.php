@extends('layout.master')

@section('content')
    <section class="container-12">
        <section class="grid-8">
            <h2>Docs</h2>

            <p>Тут будут красивые плашки с разными версиями и типами доки 🐵</p>
        </section>

        <aside class="grid-4">
            <h3>Последние обновления</h3>

            <nav>
                <ul>
                    @foreach($latest as $docs)
                        <li>
                            <a href="{{ route('docs.show', ['version' => $docs->version, 'slug' => $docs->slug]) }}">
                                {{ $docs->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </aside>
    </section>
@stop