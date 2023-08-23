<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\PostComment;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->search ??'';
        if($search != ''){
            $posts = Post::where(function($query) use ($search){
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%')
                    ->orWhereHas('category', function($query) use ($search){
                        $query->where('name', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('tags', function($query) use ($search){
                        $query->where('name', 'like', '%'.$search.'%');
                    });
            })->orderBy('created_at', 'desc')->paginate(4);
        }
        else{
            $posts = Post::orderBy('created_at', 'desc')->paginate(4);
        }

        return view('Frontend.blog.index', compact('posts'));
    }
    public function getPostByCategory(Request $request, $categoryName){
       $categoryName = str_replace('-', ' ', $categoryName);
    //    echo $categoryName;
        if($categoryName){
            $category = Category::where('name', $categoryName)->first();
            // echo $category;
            $posts  = Post::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(4);
        }
        else{
            $posts  = Post::orderBy('created_at', 'desc')->paginate(4);
        }
        return view('Frontend.blog.index', compact('posts'));
    }
    public function getPostByTag(Request $request, $tagName){
        $tag = str_replace('-', ' ', $tagName);
        if($tag){
            $posts  = Post::whereHas('tags', function($query) use ($tag){
                $query->where('name', $tag);
            })->orderBy('created_at', 'desc')->paginate(4);
        }
        else{
            $posts  = Post::orderBy('created_at', 'desc')->paginate(4);
        }
        return view('Frontend.blog.index', compact('posts'));
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
    public function show(Request $request,$titleName)
    {
        //
        $title = str_replace('-', ' ', $titleName);
        $post_id = Post::where('title', $title)->first()->id;
        $comments = Post::findOrFail($post_id);
        $list_comments = $comments->comments()->whereNull('parent_id')->orderBy('created_at', 'desc')->get();
        // echo $title;
        $post = Post::where('title', $title)->first();
        if($post){
            return view('Frontend.blog.show', compact('post', 'list_comments'));
        }
    }
    public function postComment(Request $request,String $id){
        //
        $title = str_replace('-', ' ', $id);
        $post_id = Post::where('title', $title)->first()->id;
        $message = $request->message;
        $dataToValidate = [
            'message' => $message,
        ];
        $validator = Validator::make($dataToValidate,[
            'message' => 'required|max:500|min:1',
        ]);
        if($validator->fails()){
            // return response()->json([
            //     'status' => false,
            //     'errors' => $validator->errors()
            // ]);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $comment = new PostComment();
            $comment->content = $message;
            $comment->user_id = 1; // mặc định test;
            $comment->post_id = $post_id;
            // dd($comment);
            $comment->save();
            return redirect()->back();
        }
    }
    function postReply(Request $request){

        $post_id = $request->post_id;
        $parent_id = $request->comment_parent_id;
        $message = $request->message_reply;
        $dataToValidate = [
            'message' => $message,
        ];
        $validator = Validator::make($dataToValidate,[
            'message' => 'required|max:500|min:1',
        ]);
        if($validator->fails()){
            // return response()->json([
            //     'status' => false,
            //     'errors' => $validator->errors()
            // ]);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $comment = new PostComment();
            $comment->content = $message;
            $comment->user_id = 1; // mặc định test;
            $comment->post_id = $post_id; // mặc định test;
            $comment->parent_id = $parent_id;
            // dd($comment);
            $comment->save();
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
