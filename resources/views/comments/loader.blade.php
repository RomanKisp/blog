@foreach($comments as $comment)
	@include('layout.components.comment', ['comment' => $comment])
@endforeach
