<div class="blog-post">
    <div class="blog-thumb">
        <img src="assets/images/{{$post->image}}" alt="">
    </div>
    <div class="down-content">
        <span>{{$post->category->name}}</span>
        <a href="/blogs/{{str_replace(' ', '-', strtolower($post->title))}}">
            <h4>{{$post->title}}</h4>
        </a>
        <ul class="post-info">
            <li><a href="#">Bởi : {{$post->user->name}}</a></li>
            <li><a href="#">{{ $post->created_at->format('d-m-Y') }}</a></li>
            <li><a href="#">Like : {{$post->like_count}}</a></li>
            <li><a href="#">{{count($post->comments)}} Comments</a></li>
        </ul>
        <p>{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
        <div class="post-options">
            <div class="row">
                <div class="col-6">
                    <ul class="post-tags">
                        <li><i class="fa fa-tags"></i></li>
                        @foreach($post->tags as $index => $tag)
                        <li><a href="#">{{ $tag->name }}</a>{{ $index !== count($post->tags) - 1 ? ',' : '' }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="post-share">
                        <li><i class="fa fa-share-alt"></i></li>
                        <li><a href="#">Facebook</a>,</li>
                        <li><a href="#"> Twitter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>