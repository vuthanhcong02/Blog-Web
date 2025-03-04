@extends('Dashboard.layout.base')
@section('title', 'Admin Dashboard')
@section('body')
    <!-- Main -->
    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Post-Tag
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('post-tags.store') }}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="post_id" class="col-md-3 text-md-right col-form-label">Post</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="post_id" id="post_id" class="form-control">
                                        <option value="">-- Post --</option>
                                        @foreach($posts as $post)
                                        <option value="{{$post->id}}" {{old('post_id') == $post->id ? 'selected' : ''}}>
                                            {{$post->title}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('post_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="tag_id" class="col-md-3 text-md-right col-form-label">Tag</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="tag_id" id="tag_id" class="form-control">
                                        <option value="">-- Tag --</option>
                                        @foreach($tags as $tag)
                                        <option value="{{$tag->id}}" {{old('tag_id') == $tag->id ? 'selected' : ''}}>
                                            {{$tag->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('tag_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('post-tags.index') }}" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Cancel</span>
                                    </a>

                                    <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
