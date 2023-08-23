@extends('Frontend.layouts.base')
@section('title', 'Blog')
@section('body')
    <!-- Banner Starts Here -->
    <div class="heading-page header-text mt-5">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Post Details</h4>
                            <h2>Single blog post</h2>
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
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="assets/images/{{ $post->image }}" alt="">
                                    </div>
                                    <div class="down-content">
                                        <span>{{ $post->category->name }}</span>
                                        <a href="/blogs/{{ str_replace(' ', '-', strtolower($post->title)) }}">
                                            <h4>{{ $post->title }}</h4>
                                        </a>
                                        <ul class="post-info">
                                            <li><a href="#">By {{ $post->user->name }}</a></li>
                                            <li><a href="#">{{ $post->created_at->format('d-m-Y') }}</a></li>
                                            <li><a href="#">{{ count($post->comments) }} Comments</a></li>
                                        </ul>
                                        <p>
                                            {{ $post->content }}
                                        </p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i></li>
                                                        @foreach ($post->tags as $index => $tag)
                                                            <li><a
                                                                    href="#">{{ $tag->name }}</a>{{ $index !== count($post->tags) - 1 ? ',' : '' }}
                                                            </li>
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
                            <div class="col-lg-12">
                                <div class="sidebar-item comments">
                                    <div class="sidebar-heading">
                                        <h2>{{ count($post->comments) }} comments</h2>
                                    </div>
                                    <div id="comments-list">
                                        @foreach ($list_comments as $comment)
                                            <div class="content">
                                                <div class="d-flex flex-start align-items-center">
                                                    <img class="rounded-circle shadow-1-strong me-3 m-2"
                                                        src="assets/images/avatar/{{ $comment->user->avatar ?? 'default-avatar.jpeg' }}"
                                                        alt="avatar" width="60" height="60" />
                                                    <div>
                                                        <h6 class="fw-bold">{{ $comment->user->name }}</h6>
                                                        <p class="text-muted small mb-0">
                                                            {{ $comment->created_at->format('d-m-Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <p class="mt-1">
                                                    {{ $comment->content }}
                                                </p>
                                                <div class="small d-flex justify-content-start">
                                                    <a href="#!" class="d-flex align-items-center me-3 m-1">
                                                        <i class="bi bi-suit-heart"></i>
                                                        <p class="mb-0 p-2">Like</p>
                                                    </a>
                                                    <a class="m-1 reply-cmt d-flex align-items-center"
                                                        style="cursor: pointer">
                                                        <i class="bi bi-reply "></i>
                                                        <p class="mb-0 p-2 " href="javascript:void(0)" onclick="reply(this)"
                                                            data-comment-id="{{ $comment->id }}">Reply</p>
                                                    </a>
                                                </div>
                                            </div>
                                            @foreach ($comment->replies as $reply)
                                                <div class="comments-rep-list" style="padding-left: 5%">
                                                    <div class="content" data-comment-id="{{ $comment->id }}">
                                                        <div class="d-flex flex-start align-items-center">
                                                            <img class="rounded-circle shadow-1-strong me-3 m-2"
                                                                src="assets/images/avatar/{{ $comment->user->avatar ?? 'default-avatar.jpeg' }}"
                                                                alt="avatar" width="60" height="60" />
                                                            <div>
                                                                <h6 class="fw-bold">{{ $reply->user->name }}</h6>
                                                                <p class="text-muted small mb-0">
                                                                    {{ $reply->created_at->format('d-m-Y') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <p class="mt-1">
                                                            {{ $reply->content }}
                                                        </p>
                                                        <div class="small d-flex justify-content-start">
                                                            <a href="#!" class="d-flex align-items-center me-3 m-1">
                                                                <i class="bi bi-suit-heart"></i>
                                                                <p class="mb-0 p-2">Like</p>
                                                            </a>
                                                            <a class="m-1 reply-cmt d-flex align-items-center"
                                                                style="cursor: pointer">
                                                                <i class="bi bi-reply "></i>
                                                                <p class="mb-0 p-2 " href="javascript:void(0)"
                                                                    onclick="reply(this)" data-comment-id="{{ $comment->id }}">Reply</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="reply-form hidden">
                                <div class="card-footer py-3 border-0">
                                    <div class="d-flex flex-start w-100">
                                        <img class="rounded-circle shadow-1-strong me-3 m-2"
                                            src="assets/images/avatar/{{ $comment->user->avatar ?? 'default-avatar.jpeg' }}"
                                            alt="avatar" width="40" height="40" />
                                        <div class="form-outline w-100">
                                            <form action="{{ route('post.reply') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="comment_parent_id" id="comment_parent_id" />
                                                <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;" name="message_reply"></textarea>
                                                <label class="form-label" for="textAreaExample">Message</label>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn  btn-sm m-1"
                                                        style="background-color: #f48840; color: white">Post
                                                        comment</button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm m-1"
                                                        id="cancelComment" onclick="cancelComment(this)">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item submit-comment">
                                    <div class="sidebar-heading">
                                        <h2>Your comment</h2>
                                    </div>
                                    <div class="card-footer py-3 border-0">
                                        <form action="" method="post" id="commentForm"
                                            data-post-title="{{ $post->title }}">
                                            @csrf
                                            <div class="d-flex flex-start w-100">
                                                <img class="rounded-circle shadow-1-strong me-3 m-2"
                                                    src="assets/images/avatar/{{ $post->user->avatar ?? 'default-avatar.jpeg' }}"
                                                    alt="avatar" width="40" height="40" />
                                                <div class="form-outline w-100">
                                                    <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;" name="message"
                                                        id="commentContent"></textarea>
                                                    <label class="form-label" for="textAreaExample">Message</label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-primary btn-sm m-1" id="postCommentButton">Post
                                                    comment</button>
                                            </div>
                                        </form>
                                    </div>
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
                                    <div class="content">
                                        @include('Frontend.partials.categoryList')
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item tags">
                                    <div class="sidebar-heading">
                                        <h2>Tag Clouds</h2>
                                    </div>
                                    <div class="content">
                                        @include('Frontend.partials.tagList')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Phần HTML của bạn ở trên -->

    <script>
        function reply(caller) {
            document.getElementById('comment_parent_id').value = $(caller).attr('data-comment-id');
            $('.reply-form').insertAfter($(caller).closest('.content'));
            $('.reply-form').toggle('hidden');
        }

        function cancelComment(caller) {
            $(caller).closest('.reply-form').toggle('hidden');
        }
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>






@endsection
