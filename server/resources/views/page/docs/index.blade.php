@extends('layout.master')

<?php
    /** @var \App\Models\Docs[] $docs */
    /** @var \App\Models\DocsPage $page */
?>

@section('content')
    <section class="container-12" style="padding: 100px 0">
        @foreach($docs as $repo)
            <article class="grid-4">
                <h3>{{ $repo->title }}</h3>

                <ul>
                    @foreach($repo->pages as $page)
                        <li>
                            <a href="{{ route('docs.show', ['slug' => $page->slug, 'version' => $repo->version]) }}">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </article>
        @endforeach
    </section>
@stop