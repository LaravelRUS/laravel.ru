@foreach($comments as $comment)
	<div class="comment_block">
		<span><b>{{ $comment->author->username }}</b></span><br>
		<span>{{ $comment->text }}</span>
	</div>
	<hr/>
	<hr/>
@endforeach