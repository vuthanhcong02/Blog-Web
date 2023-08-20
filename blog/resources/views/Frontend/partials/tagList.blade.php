<div class="content">
    <ul>
        @foreach($tags as $tag)
        <li class="{{request()->segment(3) == str_replace(' ', '-', strtolower($tag->name)) ? 'active-tag' : ''}}">
            <a href="/blogs/tag/{{ str_replace(' ', '-', strtolower($tag->name)) }}">{{$tag->name}}
            </a>
        </li>
        @endforeach
    </ul>
</div>