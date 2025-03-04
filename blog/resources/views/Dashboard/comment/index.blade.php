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
                        Blog Comments
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
                                    <td>User ID</td>
                                    <th>User Name</th>
                                    <th>Blog Name</th>
                                    <th>isReply</th>
                                    <th>ID Comment Root</th>
                                    <th>Messages</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td class="text-center text-muted"># {{ $comment->id }}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $comment->user->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $comment->user_id }}</td>
                                        <td>{{ $comment->post->title }}</td>
                                        <td>
                                            <input type="checkbox" {{ $comment->parent_id != null ? 'checked' : '' }}/>
                                        </td>
                                        <td>{{ $comment->parent_id }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('comments.show', $comment->id) }}" data-toggle="tooltip"
                                                title="Details" data-placement="bottom"
                                                class="btn btn-outline-warning border-0 btn-sm">
                                                Details
                                            </a>
                                            <form class="d-inline" action="{{ route('comments.destroy', $comment->id) }}"
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
                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        {{ $comments->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
