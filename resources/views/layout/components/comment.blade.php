<div style="padding:10px 10px 15px 10px; margin-bottom:10px">
	<div style="margin-bottom:10px;">
		<p style="margin: 0;">Author: <b>{{ $comment->author }}</b></p>
		<small>{{ $comment->created_at }}</small>
	</div>
	<div>
		{{ $comment->comment }}
	</div>
</div>