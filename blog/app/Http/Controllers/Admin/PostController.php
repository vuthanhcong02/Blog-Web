<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Utilities\UploadFile;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('Dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories =Category::all();
        $superUsers = User::where('role','!=','user')->get();
        return view('Dashboard.post.create',compact('categories','superUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        $blog = new Post();
        if($request->hasFile('image')){
            $data['path'] = UploadFile::uploadFile($request->file('image'),'Dashboard/assets/images/blog/');
            unset($data['image']);
        }
        $blog->image = $data['path'];
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->user_id = $request->user_id;
        $blog->category_id = $request->category_id;
        $blog->save();
        // dd($data);
        return redirect()->route('posts.index')->with('success','Thêm bài viết thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = Post::findOrFail($id);
        return view('Dashboard.post.show', compact('post'));
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
    }
}
