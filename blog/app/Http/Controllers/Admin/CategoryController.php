<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $keyword = $request->search ?? '';
        if($keyword != ''){
            $categories = Category::where('name', 'like', '%'.$keyword.'%')->paginate(5);
        }
        else {
            $categories = Category::orderBy('id', 'desc')->paginate(5);
        }
        return view('Dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255|min:3|regex:/^[\p{L}\s]+$/u',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');
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
        $category = Category::findOrFail($id);
        return view('Dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,'.$category->id,'|max:255|min:3|regex:/^[\p{L}\s]+$/u',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công');
    }
}
