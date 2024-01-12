<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'title' => 'required|min:3|unique:category',
                'slug' => 'required|min:3|unique:category',
                'status' => 'required|integer',
            ],
            [
                'title.required' => 'Tiêu đề thể loại truyện không được để trống',
                'title.min' => 'Thể loại truyện phải lớn hơn :min ký tự',
                'title.unique' => 'Thể loại truyện đã tồn tại',
                'slug.required' => 'Slug không được để trống',
                'slug.min' => 'Slug phải lớn hơn :min ký tự',
                'slug.unique' => 'Slug đã tồn tại',
                'status.required' => 'Vui lòng chọn trạng thái',
                'status.integer' => 'Trạng thái phải có giá trị kiểu số'
            ]
        );

        $category = new Category();
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        return back()->with('msg', 'Thêm thể loại truyện mới thành công');
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
        $categoryDetail = Category::find($id);
        return view('backend.category.edit', compact('categoryDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(
            [
                'title' => 'required|min:3|unique:category,title,' . $id,
                'slug' => 'required|min:3|unique:category,slug,' . $id,
                'status' => 'required|integer',
            ],
            [
                'title.required' => 'Tiêu đề thể loại truyện không được để trống',
                'title.min' => 'Thể loại truyện phải lớn hơn :min ký tự',
                'title.unique' => 'Thể loại truyện đã tồn tại',
                'slug.required' => 'Slug không được để trống',
                'slug.min' => 'Slug phải lớn hơn :min ký tự',
                'slug.unique' => 'Slug đã tồn tại',
                'status.required' => 'Vui lòng chọn trạng thái',
                'status.integer' => 'Trạng thái phải có giá trị kiểu số'
            ]
        );

        $category = Category::find($id);
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        return back()->with('msg', 'Cập nhật thể loại truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
