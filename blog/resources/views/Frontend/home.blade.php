@extends('Frontend.layouts.base')
@section('title','Home')
@section('body')

<div class="main-banner header-text mt-4">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @foreach($posts_featured as $post)
            <div class="item">
                <img src="Dashboard/assets/images/blog/{{$post->image}}" alt="banner">
                <div class="item-content">
                    <div class="main-content">
                        <div class="meta-category">
                            <span>{{$post->category->name}}</span>
                        </div>
                        <a href="/blogs/{{str_replace(' ', '-', strtolower($post->title))}}">
                            <h4>{{$post->title}}</h4>
                        </a>
                        <ul class="post-info">
                            <li><a href="#">{{$post->user->name}}</a></li>
                            <li><a href="#">{{ $post->created_at->format('d-m-Y')}}</a></li>
                            <li><a href="#">{{$post->like_count}} Likes</a></li>
                            <li><a href="#">{{count($post->comments)}} Comments</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<section class="blog-posts">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row" id="offset" data-initial-posts-count="{{ count($posts_list) }}">
                        <div id="posts-container">
                        @foreach($posts_list as $post)
                            <div class="col-lg-12">
                                @include('Frontend.components.post',['posts_more' => $posts_list])
                            </div>
                        @endforeach
                        </div>
                        <div class="col-lg-12 ">
                            <div class="main-view-more">
                                <button id="view-more">View More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sidebar-item search">
                                @include('Frontend.components.search')
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item recent-posts">
                                <div class="sidebar-heading">
                                    <h2>Recent Posts</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        @include('Frontend.partials.listPostRecent')
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item categories">
                                <div class="sidebar-heading">
                                    <h2>Categories</h2>
                                </div>
                                @include('Frontend.partials.categoryList')
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item tags">
                                <div class="sidebar-heading">
                                    <h2>Tag</h2>
                                </div>
                                @include('Frontend.partials.tagList')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var offset = document.getElementById('offset').getAttribute('data-initial-posts-count');
    var viewMoreButton = document.getElementById('view-more');
    var postsContainer = document.getElementById('posts-container');

    viewMoreButton.addEventListener('click', function() {
        fetch('/more-post?offset=' + offset)
            .then(response => response.json())
            .then(posts => {
                if (posts.length > 0) {
                    var newPosts = '';

                    posts.forEach(post => {
                        const createdAt = new Date(post.created_at);
                        const formattedDate = `${createdAt.getDate()}-${createdAt.getMonth() + 1}-${createdAt.getFullYear()}`;
                        newPosts += `<div class="col-lg-12">
                        <div class="blog-post">
                            <div class="blog-thumb">
                                <img src="Dashboard/assets/images/blog/${post.image}" alt="">
                            </div>
                            <div class="down-content">
                            ${post.category ? `<span>${post.category.name}</span>` : ''}
                                <a href="/blogs/${post.title.replace(/\s+/g, '-').toLowerCase()}">
                                    <h4>${post.title}</h4>
                                </a>
                                <ul class="post-info">
                                    ${post.user ? `<li><a href="#">Bởi : ${post.user.name}</a></li>` : ''}
                                    <li><a href="#">${formattedDate}</a></li>
                                    <li><a href="#">Like : ${post.like_count}</a></li>
                                    ${post.comments ? `<li><a href="#">${post.comments.length} Comments</a></li>` : ''}
                                </ul>
                                <p>${post.content.substr(0, 150)}...</p>
                                <div class="post-options">
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="post-tags">
                                                <li><i class="fa fa-tags"></i></li>
                                                ${post.tags.map((tag, index) => `
                                                    <li><a href="#">${tag.name}${index !== post.tags.length - 1 ? ',' : ''}</a></li>
                                                `).join('')}
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
                        </div>`;
            });
                    postsContainer.insertAdjacentHTML('beforeend', newPosts);
                    offset += posts.length;
                }
                if (posts.length < 4) {
                    viewMoreButton.style.display = 'none';
                }
            });
    });
</script>
@endsection
