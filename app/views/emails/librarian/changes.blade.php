@extends("emails.layouts.default")

@section("content")
<h4>Обновившиеся страницы:</h4>
@foreach($updatedOriginalDocs as $file)
<p>{{$file['name']}} commit {{$file['commit']}}</p>
@endforeach
@stop