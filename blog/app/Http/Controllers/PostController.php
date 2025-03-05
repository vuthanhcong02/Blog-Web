<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->search ?? '';
        if ($search != '') {
            $posts = Post::where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('tags', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })->orderBy('created_at', 'desc')->paginate(4);
        } else {
            $posts = Post::orderBy('created_at', 'desc')->paginate(4);
        }

        return view('frontend.blog.index', compact('posts'));
    }
    public function getPostByCategory(Request $request, $categoryName)
    {
        $categoryName = str_replace('-', ' ', $categoryName);
        //    echo $categoryName;
        if ($categoryName) {
            $category = Category::where('name', $categoryName)->first();
            // echo $category;
            $posts  = Post::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(4);
        } else {
            $posts  = Post::orderBy('created_at', 'desc')->paginate(4);
        }
        return view('frontend.blog.index', compact('posts'));
    }
    public function getPostByTag(Request $request, $tagName)
    {
        $tag = str_replace('-', ' ', $tagName);
        if ($tag) {
            $posts  = Post::whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag);
            })->orderBy('created_at', 'desc')->paginate(4);
        } else {
            $posts  = Post::orderBy('created_at', 'desc')->paginate(4);
        }
        return view('frontend.blog.index', compact('posts'));
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
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $titleName)
    {
        //
        $title = str_replace('-', ' ', $titleName);

        // Sử dụng \ để escape các ký tự đặc biệt trong title
        $escapedTitle = addcslashes($title, '%_');
        $post = Post::where('title', 'LIKE', '%' . $escapedTitle . '%')->first();

        if ($post) {
            $post_id = $post->id;
        }
        $comments = Post::findOrFail($post_id);
        $list_comments = $comments->comments()->whereNull('parent_id')->orderBy('created_at', 'desc')->get();
        // echo $title;
        return view('frontend.blog.show', compact('post', 'list_comments'));
    }
    public function postComment(Request $request, String $id)
    {
        //
        $title = str_replace('-', ' ', $id);

        // Sử dụng \ để escape các ký tự đặc biệt trong title
        $escapedTitle = addcslashes($title, '%_');
        $post = Post::where('title', 'LIKE', '%' . $escapedTitle . '%')->first();

        if ($post) {
            $post_id = $post->id;
        }
        $message = $request->message;
        $dataToValidate = [
            'message' => $message,
        ];
        $validator = Validator::make($dataToValidate, [
            'message' => 'required|max:500|min:1',
        ]);
        if ($validator->fails()) {
            // return response()->json([
            //     'status' => false,
            //     'errors' => $validator->errors()
            // ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $comment = new PostComment();
            $comment->content = $message;
            $comment->user_id = Auth::user()->id; // mặc định test;
            $comment->post_id = $post_id;
            // dd($comment);
            $comment->save();
            return redirect()->back();
        }
    }
    function postReply(Request $request)
    {

        $post_id = $request->post_id;
        $parent_id = $request->comment_parent_id;
        $message = $request->message_reply;
        $dataToValidate = [
            'message' => $message,
        ];
        $validator = Validator::make($dataToValidate, [
            'message' => 'required|max:500|min:1',
        ]);
        if ($validator->fails()) {
            // return response()->json([
            //     'status' => false,
            //     'errors' => $validator->errors()
            // ]);
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $comment = new PostComment();
            $comment->content = $message;
            $comment->user_id = Auth::user()->id; // mặc định test;
            $comment->post_id = $post_id; // mặc định test;
            $comment->parent_id = $parent_id;
            // dd($comment);
            $comment->save();
            return redirect()->back();
        }
    }
    public function postLike(Request $request)
    {
        $postId = $request->input('post_id');
        $userId = Auth::user()->id; //test

        //Kiểm tra xem người dùng đã like bài viết chưa
        $like = Like::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            // Đã thích, xóa like
            $like->delete();
        } else {
            // Chưa thích, thêm like mới
            $like = new Like();
            $like->post_id = $postId;
            $like->user_id = $userId;
            $like->save();
        }
        $likeCount = Like::where('post_id', $postId)->count();
        return response()->json(['success' => true,
            'likeCount' => $likeCount,
        ]);
    }
    public function postUnComment(String $id){
        //
        $comment = PostComment::findOrFail($id);
        if (Auth::user()->id === $comment->user_id) {
            // Lấy danh sách comment reply
            $replies = PostComment::where('post_id', $comment->post_id)
                              ->where('parent_id', $id)
                              ->get();
            // dd($replies);
            // Gọi đệ quy cho từng comment reply
            foreach ($replies as $reply) {
                // $this->postUnComment($reply->id);
                $reply->delete();
                // dd($replies);
            }

            // // Xóa comment
            PostComment::destroy($id);
            return redirect()->back();
        }else{
            toastr()->timeOut(2000)
                    ->newestOnTop(true)
                    ->addError('Bạn không có quyền xóa bình luận người khác.');
            return redirect()->back();
        }
        // dd($replyComments);

    }
    public function postUnCommentReply(String $id){
        $reply = PostComment::findOrFail($id);
        if (Auth::user()->id === $reply->user_id) {
            $reply->delete();
            return redirect()->back();
        }
        else{
            toastr()->timeOut(2000)
                    ->newestOnTop(true)
                    ->addError('Bạn không có quyền xóa bình luận người khác.');
            return redirect()->back();
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
