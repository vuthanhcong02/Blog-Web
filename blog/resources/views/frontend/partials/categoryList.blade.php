<div class="content">
    <ul>
        @foreach($categories as $category)
        <li >
            <a class="{{request()->segment(3) == str_replace(' ', '-', strtolower($category->name)) ? 'active' : ''}}" 
                href="/blogs/category/{{ str_replace(' ', '-', strtolower($category->name)) }}">{{ $category->name }}
            </a>
        </li>
        @endforeach
    </ul>
</div>