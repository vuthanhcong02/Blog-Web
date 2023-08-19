<div class="content">
    <ul>
        @foreach($categories as $category)
        <li><a href="">{{$category->name}}</a></li>
        @endforeach
    </ul>
</div>