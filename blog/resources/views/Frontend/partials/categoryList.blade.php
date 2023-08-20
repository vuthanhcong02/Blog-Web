<div class="content">
    <ul>
        @foreach($categories as $category)
        <li >
            <a class="{{request()->segment(2) == str_replace(' ', '-', strtolower($category->name)) ? 'active' : ''}}" 
                href="/blogs/{{ str_replace(' ', '-', strtolower($category->name)) }}">{{ $category->name }}
            </a>
        </li>
        @endforeach
    </ul>
</div>