@foreach($comments as $comment)
	<div class="comment_block">
		<span><b>{{ $comment->author->name }}</b></span><br>
		<span>{{ $comment->text }}</span>
	</div>
	<hr/>
	<hr/>
@endforeach