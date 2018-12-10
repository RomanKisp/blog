@extends('layout.basic')

@section('content')
	<div class="row">
	    <div class="col-md-2">
	        <p>Category name:</p>
	    </div>
	    <div class="col-md-8">
	        ---
	    </div>
	</div>
	<br/>
	<div class="row">
		<div class="col-md-12">
			<div><b style="text-transform: uppercase">Posts without category:</b></div><br/>
			@include('posts.index', ['posts' => $posts])
		</div>
	</div>
@stop
