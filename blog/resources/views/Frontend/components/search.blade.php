<form id="search_form" name="gs" method="GET" action="/blogs">
    <div class="d-flex">
        <input type="text" name="search" value="{{request('search')}}" class="searchText" placeholder="type to search..." autocomplete="on">
        <button type="submit" id="view-more">Search</button>
    </div>
</form>