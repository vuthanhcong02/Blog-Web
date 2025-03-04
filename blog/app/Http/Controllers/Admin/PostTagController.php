<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list_post_tags = Post::
                    orderBy('id', 'desc')->paginate(5);
        return view('Dashboard.post-tags.index', compact('list_post_tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $posts = Post::orderBy('id', 'desc')->get();
        $tags = Tag::orderBy('id', 'desc')->get();
        return view('Dashboard.post-tags.create', compact('posts', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'post_id' => 'required',
            'tag_id' => 'required|exists:tags,id'
        ]);

        $postTag = PostTag::create($data);

        return redirect()->route('post-tags.index')->with('success', 'Đã thêm PostTag mới.');

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
