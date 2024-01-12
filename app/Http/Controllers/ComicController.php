<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_multiple;
use App\Models\Comic;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = Comic::with('categories')->orderBy('id', 'DESC')->get();

        return view('backend.comic.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::orderBy('id', 'DESC')->get();
        return view('backend.comic.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'title' => 'required|min:3|unique:comic',
                'slug' => 'required|min:3|unique:comic',
                'description' => 'required',
                'status' => 'required|integer',
                'seo' => 'required|min:6',
                'author' => 'required|min:3',
                'image' => 'required',
                'category' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute không được nhỏ hơn :min ký tự',
                'unique' => ':attribute đã tồn tại',
            ],
            [
                'title' => 'Tiêu đề',
                'description' => 'Mô tả',
                'status' => 'Trạng thái',
                'seo' => 'Từ khóa',
                'author' => 'Tác giả',
                'image' => 'Hình ảnh',
                'category' => 'Thể loại',
            ]
        );

        $comic = new Comic();
        $comic->title = $request->title;
        $comic->seo = $request->seo;
        $comic->description = $request->description;
        $comic->author = $request->author;
        $comic->slug = $request->slug;
        $comic->status = $request->status;

        // xử lý thể loại (comic)
        $category = $request->category;
        foreach ($category as $key => $cate) {
            $comic->category_id = $cate[0];
        }
        // xử lý image
        $get_image = $request->image;
        $path = "uploads/comic/";
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $comic->image = $new_image;
        $comic->save();

        // xử lý thể loại
        $comic->category_multiple()->attach($request->category);

        return redirect()->back()->with('msg', 'Thêm truyện mới thành công');
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
        $comicDetail = Comic::find($id);
        $category = Category::all();

        // xử lý checked
        $cate_multiple = Category_multiple::where('comic_id', $id)->get();
        $cateArr = [];
        foreach ($cate_multiple as $key => $item) {
            $cateArr[$item->category_id] = $item->category_id;
        }

        return view('backend.comic.edit', compact('comicDetail', 'category', 'cateArr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(
            [
                'title' => 'required|min:3|unique:comic,title,' . $id,
                'slug' => 'required|min:3|unique:comic,slug,' . $id,
                'description' => 'required',
                'status' => 'required|integer',
                'seo' => 'required|min:6',
                'author' => 'required|min:3',
                // 'image' => 'required',
                'category' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute không được nhỏ hơn :min ký tự',
                'unique' => ':attribute đã tồn tại',
            ],
            [
                'title' => 'Tiêu đề',
                'description' => 'Mô tả',
                'status' => 'Trạng thái',
                'seo' => 'Từ khóa',
                'author' => 'Tác giả',
                // 'image' => 'Hình ảnh',
                'category' => 'Thể loại',
            ]
        );

        $comic = Comic::find($id);
        $comic->title = $request->title;
        $comic->seo = $request->seo;
        $comic->description = $request->description;
        $comic->author = $request->author;
        $comic->slug = $request->slug;
        $comic->status = $request->status;

        // xử lý thể loại (comic)
        $category = $request->category;
        foreach ($category as $key => $cate) {
            $comic->category_id = $cate[0];
        }
        // xử lý image
        if (!empty($request->image)) {
            $path = 'uploads/comic/' . $comic->image;
            if (file_exists($path)) {
                unlink($path);
            }

            $get_image = $request->image;
            $path = "uploads/comic/";
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $comic->image = $new_image;
        }

        $comic->save();

        // xóa thể loại cũ (không tối ưu, tốn nhiều tài nguyên)
        Category_multiple::where('comic_id', $comic->id)->delete();

        // xử lý thể loại
        $comic->category_multiple()->attach($request->category);

        return redirect()->back()->with('msg', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}