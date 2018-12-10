@extends('layout.basic')

@section('content')
    <div class="row">
        <div class="col-md-3">
        	<a  href="{{ route('categories.create') }}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add new <b>category</b></a><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading"><h4>categories</h4></div>
				<div class="list-group">
					@if($elements['categories'] && count($elements['categories'])>0)
						@foreach($elements['categories'] as $category)
							<a href="{{ route('categories.show', $category->id) }}" class="list-group-item">{{ $category->name }} ({{ count($category->posts) }})</a>
						@endforeach
					@else
						<a href="{{ route('categories.create') }}" class="list-group-item">No categories. Please add.</a>
					@endif
					@if($elements['posts_without_category'])
						<a href="{{ route('posts_without_category') }}" class="list-group-item list-group-item-warning">without category ({{ $elements['posts_without_category'] }})</a>
					@endif
				</div>
			</div>
		</div>
        <div class="col-md-9">
        	<a href="{{ route('posts.create') }}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add new <b>post</b></a><br><br>
			@if($elements['posts'] && count($elements['posts'])>0)
				@include('posts.index', ['posts' => $elements['posts']])
			@else
			    <p>No posts</p>
			@endif
        </div>
    </div>
@stop

