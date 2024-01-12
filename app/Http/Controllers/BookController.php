<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Book::orderBy('id', 'DESC')->get();
        return view('backend.book.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('backend.book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'title' => 'required|min:6|unique:book',
                'slug' => 'required|min:6|unique:book',
                'description' => 'required',
                'status' => 'required|integer',
                'seo' => 'required|min:6',
                'content' => 'required|min:6',
                'image' => 'required'
            ],
            [
                'required' => ':attribute không được để trông',
                'min' => ':attribute không được quá :min ký tự',
                'unique' => ':attribute đã tồn tại',
                'integer' => ':attribute phải là số nguyên'
            ],
            [
                'title' => 'Tiêu đề sách',
                'slug' => 'Slug sách',
                'description' => 'Mô tả sách',
                'status' => 'Trạng thái',
                'seo' => 'Từ khóa',
                'content' => 'Nội dung',
                'image' => 'Hình ảnh'
            ]
        );

        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->slug = $request->slug;
        $book->seo = $request->seo;
        $book->content = $request->content;
        $book->status = $request->status;
        $book->view = 0;
        // xử lý image
        $get_image = $request->image;
        $path = "uploads/book/";
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $book->image = $new_image;
        $book->save();

        return back()->with('msg', 'Thêm sách mới thành công');
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
        $bookDetail = Book::find($id);
        return view('backend.book.edit', compact('bookDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(
            [
                'title' => 'required|min:6|unique:book,title,' . $id,
                'slug' => 'required|min:6|unique:book,slug,' . $id,
                'description' => 'required',
                'status' => 'required|integer',
                'seo' => 'required|min:6',
                'content' => 'required|min:6',
            ],
            [
                'required' => ':attribute không được để trông',
                'min' => ':attribute không được quá :min ký tự',
                'unique' => ':attribute đã tồn tại',
                'integer' => ':attribute phải là số nguyên'
            ],
            [
                'title' => 'Tiêu đề sách',
                'slug' => 'Slug sách',
                'description' => 'Mô tả sách',
                'status' => 'Trạng thái',
                'seo' => 'Từ khóa',
                'content' => 'Nội dung',
            ]
        );

        $book = Book::find($id);
        $book->title = $request->title;
        $book->description = $request->description;
        $book->slug = $request->slug;
        $book->seo = $request->seo;
        $book->content = $request->content;
        $book->status = $request->status;
        $book->view = 0;
        // xử lý image
        $get_image = $request->image;
        if ($get_image) {
            $path = 'uploads/book/' . $book->image;
            if (file_exists($path)) {
                unlink($path);
            }

            $path = "uploads/book/";
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $book->image = $new_image;
        }
        $book->save();

        return back()->with('msg', 'Cập nhật sách thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
