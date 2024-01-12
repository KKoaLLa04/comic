<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = Chapter::with('comic')->orderBy('id', 'DESC')->get();
        return view('backend.chapter.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $comic = Comic::orderBy('id', 'DESC')->get();
        return view('backend.chapter.create', compact('comic'));
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
                'description' => 'required',
                'content' => 'required',
                'status' => 'required|integer',
                'comic_id' => 'required|integer',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute không được nhỏ hơn :min ký tự',
                'unique' => ':attribute đã tồn tại',
                'integer' => ':attribute phải là kiểu số nguyên',
            ],
            [
                'title' => 'Tiêu đề chương',
                'slug' => 'Slug chương',
                'description' => 'Mô tả ngắn',
                'content' => 'Nội dung chương',
                'status' => 'Trạng thái',
                'comic_id' => 'Danh mục',
            ]
        );

        $chapter = new Chapter();
        $chapter->title = $request->title;
        $chapter->slug = $request->slug;
        $chapter->description = $request->description;
        $chapter->content = $request->content;
        $chapter->status = $request->status;
        $chapter->comic_id = $request->comic_id;
        $chapter->save();

        return back()->with('msg', 'Thêm chương truyện mới thành công');
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
        $chapterDetail = Chapter::find($id);
        $comic = Comic::orderBy('id', 'DESC')->get();
        return view('backend.chapter.edit', compact('chapterDetail', 'comic'));
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
                'description' => 'required',
                'content' => 'required',
                'status' => 'required|integer',
                'comic_id' => 'required|integer',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute không được nhỏ hơn :min ký tự',
                'unique' => ':attribute đã tồn tại',
                'integer' => ':attribute phải là kiểu số nguyên',
            ],
            [
                'title' => 'Tiêu đề chương',
                'slug' => 'Slug chương',
                'description' => 'Mô tả ngắn',
                'content' => 'Nội dung chương',
                'status' => 'Trạng thái',
                'comic_id' => 'Danh mục',
            ]
        );

        $chapter = Chapter::find($id);
        $chapter->title = $request->title;
        $chapter->slug = $request->slug;
        $chapter->description = $request->description;
        $chapter->content = $request->content;
        $chapter->status = $request->status;
        $chapter->comic_id = $request->comic_id;
        $chapter->save();

        return back()->with('msg', 'Cập nhật chương truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
