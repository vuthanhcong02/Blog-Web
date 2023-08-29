<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Utilities\UploadFile;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $keyword = $request->search ?? '';
        if($keyword != ''){
            $posts = Post::where('title', 'like', '%'.$keyword.'%')
                           ->orWhereHas('category', function($query) use ($keyword){
                               $query->where('name', 'like', '%'.$keyword.'%');
                           })
                           ->orWhereHas('user', function($query) use ($keyword){
                               $query->where('name', 'like', '%'.$keyword.'%');
                           })
                            ->orderBy('id', 'desc')->paginate(5);
        }
        else{
            $posts = Post::orderBy('id', 'desc')->paginate(5);
        }
        // $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('Dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        $superUsers = User::where('role', '!=', 'user')->get();
        return view('Dashboard.post.create', compact('categories', 'superUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $blog = new Post();

            if ($request->hasFile('image')) {
                $imagePath = $this->uploadImage($request->file('image'));
                session()->put('temporary_image', $imagePath);
                $blog->image = $imagePath;
            }

            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->user_id = $request->user_id;
            $blog->category_id = $request->category_id;

            $blog->save();
            return redirect()->route('posts.index')->with('success', 'Thêm bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình thêm bài viết.');
        }
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
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $superUsers = User::where('role', '!=', 'user')->get();
        return view('Dashboard.post.edit', compact('categories', 'superUsers', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        try {
            $post = Post::findOrFail($id);

            if ($request->hasFile('image')) {
                // Xóa ảnh cũ
                $this->deleteOldImage($post->image);

                // Lưu ảnh mới
                $imagePath = $this->uploadImage($request->file('image'));
                $post->image = $imagePath;
            }

            // Cập nhật các trường khác
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = $request->user_id;
            $post->category_id = $request->category_id;

            $post->save();

            return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công');
        } catch (\Exception $e) {
            // Xử lý lỗi và hiển thị thông báo
            return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình cập nhật bài viết.');
        }
    }

    protected function deleteOldImage($imagePath)
    {
        if ($imagePath && Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    }

    protected function uploadImage($imageFile)
    {
        $imagePath = UploadFile::uploadFile($imageFile, 'Dashboard/assets/images/blog/');
        return $imagePath;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $image_name = Post::find($id)->image;
        // dd($image_name);
        if($image_name !=''){
            unlink('Dashboard/assets/images/blog/' . $image_name);
        }
        Post::find($id)->delete();
        return redirect()->route('posts.index')->with('success', 'Xóa bài viết thành công');
    }
}
