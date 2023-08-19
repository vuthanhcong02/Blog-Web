<div class="content">
    <ul>
        @foreach($tags as $tag)
        <li><a href="">{{$tag->name}}</a></li>
        @endforeach
    </ul>
</div>