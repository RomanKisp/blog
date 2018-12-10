@extends('layout.basic')

@section('content')
	<div class="row">
	    <div class="col-md-2">
	        <p>Category name:</p>
	    </div>
	    <div class="col-md-8">
	        <p><b>{{ $category->name }}</b></p>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-2">
	        <p>Description:</p>
	    </div>
	    <div class="col-md-10">
	        <p>{{ $category->description }}</p>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-2">
	        <p>Actions:</p>
	    </div>
	    <div class="col-md-10 clearfix">
		   	<div class="pull-left">
		        <a href="{{ route('posts.create') }}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add new <b>post</b></a><br><br>
		    </div>
		   	<div class="pull-left" style="padding-left: 10px;">
		        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default" role="button"><span class="glyphicon glyphicon-edit"></span></a>
		    </div>
		    <div class="pull-left" style="padding-left: 10px;">
		        @include('layout.components.delete', ['path' => "/categories/$category->id"])
		    </div>
		</div>
	</div>
	<br/>
	<div class="row">
		<div class="col-md-12">
			<div><b style="text-transform: uppercase">Category posts:</b></div><br/>
			@if(isset($posts) && count($posts)>0)
				@include('posts.index', ['posts' => $posts])
			@else
			    <p>No posts</p>
			@endif
		</div>
	</div>
	<br/>
	<div class="row">	
		<div class="col-md-12">
			<div><b style="text-transform: uppercase">Comments:</b></div><br/>
			@include('comments.form', ['object' => $category])
		</div>
		<div class="col-md-12" id="comments_list">
			@include('comments.loader', ['comments' => $category->attachableComments])
    	</div>
	</div>
@stop
