<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostComment;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $posts_list = Post::take(4)->get();
        $posts_featured = Post::where('like_count', '>=', 10)->orderBy('like_count', 'desc')->get();
        return view('Frontend.home', compact('posts_featured', 'posts_list'));
    }
    public function loadMore(Request $request)
    {

        $offset = $request->input('offset', 0);
        $limit = 4; // Số lượng bài viết mỗi lần tải

        // $posts = Post::skip($offset)->take($limit)->get();
        $posts = Post::with(['category', 'user', 'comments', 'tags'])
            ->skip($offset)
            ->take($limit)
            ->get();


        return response()->json($posts);
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
