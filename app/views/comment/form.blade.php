@if(Auth::id())
	{{ Form::open(['route' => 'comment.store', 'method' => 'post']) }}
		<textarea name="text" id="" cols="30" rows="10"></textarea>
		<input type="hidden" name="commentable_type" value="{{ $commentable_type }}"/>
		<input type="hidden" name="commentable_id" value="{{ $commentable_id }}"/>
		<input type="submit"/>
	{{ Form::close() }}
@endif