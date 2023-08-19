@extends('Frontend.layouts.base')
@section('title','Blog')
@section('body')

<div class="main-banner header-text mt-4">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @foreach($posts_featured as $post)
            <div class="item">
                <img src="assets/images/{{$post->image}}" alt="banner">
                <div class="item-content">
                    <div class="main-content">
                        <div class="meta-category">
                            <span>{{$post->category->name}}</span>
                        </div>
                        <a href="post-details.html">
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
                    <div class="row">
                        @foreach($posts_list as $post)
                        <div class="col-lg-12">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="assets/images/{{$post->image}}" alt="">
                                </div>
                                <div class="down-content">
                                    <span>{{$post->category->name}}</span>
                                    <a href="post-details.html">
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
                        </div>
                        @endforeach
                        <div class="col-lg-12">
                            <div class="main-button">
                                <a href="blog.html">View More</a>
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
                                <form id="search_form" name="gs" method="GET" action="#">
                                    <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item recent-posts">
                                <div class="sidebar-heading">
                                    <h2>Recent Posts</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        <li><a href="post-details.html">
                                                <h5>Vestibulum id turpis porttitor sapien facilisis scelerisque</h5>
                                                <span>May 31, 2020</span>
                                            </a></li>
                                        <li><a href="post-details.html">
                                                <h5>Suspendisse et metus nec libero ultrices varius eget in risus</h5>
                                                <span>May 28, 2020</span>
                                            </a></li>
                                        <li><a href="post-details.html">
                                                <h5>Swag hella echo park leggings, shaman cornhole ethical coloring</h5>
                                                <span>May 14, 2020</span>
                                            </a></li>
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
@endsection