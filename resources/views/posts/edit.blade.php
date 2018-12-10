@extends('layout.basic')

@section('content')
    <div class="row">
        <div class="col-md-12" style="font-size:24px; text-align: center;">
            <p>Edit post</p>
        </div> 
        <div class="col-md-12">
        @if ($errors->any())
            @include('layout.components.errors', ['errors' => $errors])
        @endif
            <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label">Category</label>
                    <select class="form-control" name="category_id">
                        <option value="" {{ $errors->any() ? (old('category_id') == null ? 'selected' : '') : ($post->category_id == null ? 'selected' : '') }}>
                            ---
                        </option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $errors->any() ? (old('category_id') == $category->id ? 'selected' : '') : ($post->category && $post->category->id == $category->id ? 'selected' : '') }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input class="form-control" type="text" name="name" value="{{ $errors->any() ? old('name') : $post->name }}">
                </div>
                @if($post->files)
                    <label class="control-label">Attached file:</label> {{ $post->files->name }}
                @endif
                    <div class="form-group">
                        <label class="control-label">{{ $post->files ? 'Replace file' : 'File' }}</label>
                        <input type="file" name="file">
                    </div>
                <div class="form-group">
                    <label class="control-label">Content</label>
                    <textarea id="content" name="content">{{ $errors->any() ? old('content') : $post->content }}</textarea>
                </div>
                <input type="submit" value="Save" class="btn btn-primary pull-right">
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default pull-right" style="margin-right:20px">Close</a>
            </form>
        </div>
    </div>
@stop