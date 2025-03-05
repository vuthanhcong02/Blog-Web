@extends('frontend.layouts.base')
@section('title','Blog')
@section('body')
<!-- Banner Starts Here -->
<div class="heading-page header-text mt-5">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Recent Posts</h4>
                        <h2>Our Recent Blog Entries</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Banner Ends Here -->
<section class="blog-posts grid-system">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                        @if($posts -> count() > 0)
                        @foreach($posts as $post)
                        <div class="col-lg-6">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="dashboard/assets/images/blog/{{$post->image}}" alt="">
                                </div>
                                <div class="down-content">
                                    <span>{{$post->category->name}}</span>
                                    <a href="/blogs/{{str_replace(' ', '-', strtolower($post->title))}}">
                                        <h4>{{$post->title}}</h4>
                                    </a>
                                    <ul class="post-info">
                                        <li><a href="#">By {{$post->user->name}}</a></li>
                                        <li><a href="#">{{ $post->created_at->format('d-m-Y')}}</a></li>
                                        <li><a href="#">{{count($post->comments)}} Comments</a></li>
                                    </ul>
                                    <p>{!! \Illuminate\Support\Str::limit($post->content, 100) !!}</p>
                                    <div class="post-options">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="post-tags">
                                                    @foreach($post->tags as $index => $tag)
                                                    <li><a href="#">{{ $tag->name }}</a> {{ $index !== count($post->tags) - 1 ? ',' : '' }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            @include('frontend.components.PostnotFound')
                        @endif
                        <div class="col-lg-12">
                            {{$posts->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sidebar-item search">
                                @include('frontend.components.search')
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item recent-posts">
                                <div class="sidebar-heading">
                                    <h2>Recent Posts</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        @include('frontend.partials.listPostRecent')
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item categories">
                                <div class="sidebar-heading">
                                    <h2>Categories</h2>
                                </div>
                                <div class="content">
                                    @include('frontend.partials.categoryList')
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item tags">
                                <div class="sidebar-heading">
                                    <h2>Tag Clouds</h2>
                                </div>
                                <div class="content">
                                    @include('frontend.partials.tagList')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
