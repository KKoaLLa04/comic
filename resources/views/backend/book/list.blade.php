@extends('layouts.layouts')

@section('title', 'Liệt kê sách đọc')

@section('content')
    <div class="container-fluid">
        <h3>Sách Đọc</h3>
        <a href="{{route('admin.book.create')}}" class="btn btn-success">Thêm Sách <i class="fa fa-plus"></i></a>
        <hr>
        @if(session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th width="10%">Ảnh MH</th>
                    <th>Tiêu đề</th>
                    <th>từ khóa</th>
                    <th>Mô tả</th>
                    <th>Ngày thêm</th>
                    <th width="15%">Trạng thái</th>
                    <th width="8%" class="text-center">Sửa</th>
                    <th width="8%" class="text-center">Xóa</th>
                </tr>
            </thead>

            <tbody>
                @if(!empty($list))
                    @foreach($list as $key => $book)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src="{{asset("uploads/book/$book->image")}}" width="100%"></td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->seo}}</td>
                            <td>{!!$book->description!!}</td>
                            <td>{{$book->created_at->diffForHumans()}}</td>
                            <td class="text-center">{!!($book->status==0?'<span class="btn btn-danger">Không kích hoạt</span>':'<span class="btn btn-success">Kích hoạt</span>')!!}</td>
                            <td class="text-center"><a href="{{route('admin.book.edit', $book)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                            <td class="text-center"><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach 
                @endif
            </tbody>
        </table>
    </div>
@endsection