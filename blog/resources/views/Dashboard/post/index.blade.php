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
                        Post
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="{{ route('posts.create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Create
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="Search everything"
                                    class="form-control" value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>

                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Hỉnh ảnh</th>
                                    <th class="text-center">Tiêu đề</th>
                                    <th class="text-center">Nội dung</th>
                                    <th class="text-center">Tác giả</th>
                                    <th class="text-center">Danh mục</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($posts) > 0)
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td class="text-center text-muted"># {{ $post->id }}</td>
                                            <td class="text-center">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-center mr-3">
                                                            <div class="widget-content-left">
                                                                <img style="height: 60px;object-fit: cover" data-toggle="tooltip"
                                                                    title="Image" data-placement="bottom"
                                                                    src="Dashboard/assets/images/blog/{{ $post->image ?? '' }}"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ substr($post->title ?? '', 0 , 50) }}...</td>
                                            <td class="text-center">{!! substr($post->content ?? '', 0,150) !!}...</td>
                                            <td class="text-center">{{ $post->user->name ?? '' }}</td>
                                            <td class="text-center">{{ $post->category->name ?? '' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('posts.show', $post->id) }}"
                                                    class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                                    Details
                                                </a>
                                                <a href="{{ route('posts.edit', $post->id) }}" data-toggle="tooltip"
                                                    title="Edit" data-placement="bottom"
                                                    class="btn btn-outline-warning border-0 btn-sm">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-edit fa-w-20"></i>
                                                    </span>
                                                </a>
                                                <form class="d-inline" action="{{ route('posts.destroy', $post->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                        type="submit" data-toggle="tooltip" title="Delete"
                                                        data-placement="bottom"
                                                        onclick="return confirm('Do you really want to delete this item?')">
                                                        <span class="btn-icon-wrapper opacity-8">
                                                            <i class="fa fa-trash fa-w-20"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <div class="alert alert-danger text-center">Không tìm thấy kết quả nào phù hợp.
                                        </div>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
