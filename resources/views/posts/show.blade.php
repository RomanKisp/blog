@extends('layout.basic')

@section('content')
	<div class="row">
	    <div class="col-md-2">
	        <p>Post name:</p>
	    </div>
	    <div class="col-md-8">
	        <p><b>{{ $post->name }}</b></p>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-2">
	        <p>Category:</p>
	    </div>
	    <div class="col-md-8">
			@if($post->category)
			<a href="{{ route('categories.show', $post->category->id) }}">
				{{ $post->category->name }}
			</a>
			@else
			 	<span>---</span>
			@endif
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-2">
	        <p>File:</p>
	    </div>
	    <div class="col-md-8">
			@if($post->files)
				<a href="{{ asset('storage/'.$post->files->path) }}">
					{{ $post->files->name }}
				</a>
			@else
			 	<span>No files</span>
			@endif
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-2">
	        <p>Actions:</p>
	    </div>
	    <div class="col-md-10 clearfix">
		   	<div class="pull-left">
		        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default" role="button"><span class="glyphicon glyphicon-edit"></span></a>
		    </div>
		    <div class="pull-left" style="padding-left: 10px;">
		        @include('layout.components.delete', ['path' => "/posts/$post->id"])
		    </div>
		</div>
	</div>
	<br/>
	<div class="row">
		<div class="col-md-12">
			<div><b style="text-transform: uppercase">Content:</b></div><br/>
			{!! $post->content !!}
		</div>
	</div>
	<br/>
	<div class="row">	
		<div class="col-md-12">
			<div><b style="text-transform: uppercase">Comments:</b></div><br/>
			@include('comments.form', ['object' => $post])
		</div>
		<div class="col-md-12" id="comments_list">
			@include('comments.loader', ['comments' => $post->attachableComments])
    	</div>
	</div>
@stop