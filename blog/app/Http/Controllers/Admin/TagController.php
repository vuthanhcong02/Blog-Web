<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $keyword = $request->search ?? '';
        if($keyword != ''){
            $tags = Tag::where('name', 'like', '%'.$keyword.'%')->paginate(5);
        }
        else {
            $tags = Tag::orderBy('id', 'desc')->paginate(5);
        }
        return view('Dashboard.tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Dashboard.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags|max:255|min:3|regex:/^[\p{L}\s]+$/u',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index')->with('success', 'Thêm tag thành công');
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
        $tag = Tag::findOrFail($id);
        return view('Dashboard.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $tag = Tag::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags,name,'.$tag->id,'|max:255|min:3|regex:/^[\p{L}\s]+$/u',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index')->with('success', 'Cập nhật tag thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Xóa tag thành công');
    }
}
