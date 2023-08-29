<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostComment;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $keyword = $request->search ?? '';
        if($keyword != '') {
            $comments = PostComment::where('content', 'like', '%' . $keyword . '%')
                                    ->orWhereHas('post', function ($query) use ($keyword) {
                                        $query->where('title', 'like', '%' . $keyword . '%');
                                    })
                                    ->orWhereHas('user', function ($query) use ($keyword) {
                                        $query->where('name', 'like', '%' . $keyword . '%');
                                    })
                                    ->orderBy('created_at', 'desc')->paginate(5);
        }
        else {
            $comments = PostComment::orderBy('created_at', 'desc')->paginate(5);
        }
        return view('Dashboard.comment.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $comment = PostComment::find($id);
        return view('Dashboard.comment.show',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $comment = PostComment::find($id);
        $comment_reply = PostComment::where('parent_id', $comment->id)->get();
        foreach ($comment_reply as $item) {
            $item->delete();
        }
        $comment->delete();
        return redirect()->back()->with('success','Xóa bình luận thành công');
    }
}
