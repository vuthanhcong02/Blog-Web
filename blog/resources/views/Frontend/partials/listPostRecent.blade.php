@foreach($posts_recent as $post)
<li>
    <a href="blogs/details/{{$post->id}}">
        <h5>{{$post->title}}</h5>
        <span>{{$post->created_at->format('d-m-Y')}}</span>
    </a>
</li>
@endforeach