<ul class="list-unstyled">
    @foreach($posts as $post)
        <li style="border-bottom: 1px solid #999;">
            <h4><a href="{{ route('posts.show', $post->id) }}">{{ $post->name }}</a></h4>
            <div class="clearfix">
                <div class="pull-left">
                    <small>category: 
                        @if($post->category)
                            <b>{{ $post->category->name }}</b>
                        @else
                            <b>---</b>
                        @endif
                    </small>
                </div>
                <div class="pull-right"><small><b>{{ date("d M Y", strtotime($post->created_at)) }}</b></small></div>
            </div>
            <p>{!! str_limit($post->content, 300) !!}</p>
            <a href="{{ route('posts.show', $post->id) }}">read more...</a><br><br>
        </li>
    @endforeach
</ul>
<div>{{ $posts->links() }}</div>
