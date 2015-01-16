@extends('layouts.documentation')

@section('title', 'Статус перевода')

@section('container')
	<main class="container">
		<article class="bg-white p-35-45">
			<header class="bordered m-b-30">
				<h1>Статус перевода</h1>
				<p>Если вы хотите помочь с переводом документации, ознакомьтесь пожалуйста с этой <a href="/content/rus-documentation-contribution-guide">инструкцией</a>.</p>
			</header>
			<ul class="list-unstyled">
			@foreach($versions as $version)
				<li>
					<article>
						<header>
							<h2>Ветка <a href="https://github.com/laravel/docs/tree/{{ $version->number_alias }}">{{ $version->number_alias }}</a></h2>
						</header>
						<table>
							<thead>
								<tr class="row">
									<th class="hidden-xs col-sm-1 text-center">#</th>
									<th class="col-xs-9 col-md-2 col-lg-3">Наименование</th>
									<th class="hidden-xs hidden-sm col-md-4 col-lg-3">Оригинал</th>
									<th class="col-xs-3 col-sm-2 col-md-5">Статус <span class="hidden-xs hidden-sm">перевода</span></th>
								</tr>
							</thead>
							<tbody>
							@foreach($version->documentation as $i => $doc)
								<tr class="row">
									<td class="hidden-xs col-sm-1 text-center">{{ $i + 1 }}</td>
									<td class="col-xs-9 col-md-2 col-lg-3">
										<a href="{{ route('documentation', [checkMasterVersion($doc->frameworkVersion), $doc->page]) }}">{{ $doc->page }}</a>
									</td>
									<td class="hidden-xs hidden-sm col-md-4 col-lg-3">
										<a href="https://github.com/laravel/docs/blob/{{ $doc->current_original_commit }}/{{ $doc->page }}.md">{{ $doc->current_original_commit }}</a>
									</td>
									<td class="col-xs-3 col-sm-2 col-md-5">
										@if( ! $doc->original_commits_ahead)
											<span class="c-green">
												<i class="fa fa-circle"></i> <span class="hidden-xs hidden-sm">перевод не требуется</span>
											</span>
										@else
											<span class="c-red"><i class="fa fa-circle"></i> {{ $doc->original_commits_ahead }}</span>
											<span class="hidden-xs hidden-sm">git difftool {{ substr($doc->last_original_commit, 0, 7) }} {{ substr($doc->current_original_commit, 0, 7) }} {{ $doc->page }}.md</span>
										@endif
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</article>
				</li>
			@endforeach
			</ul>
		</article>
	</main>
@stop
