@extends('layouts.layouts')

@section('title', 'Danh sách truyện sách')

@section('content')
    <div class="container-fluid">
        <h3>Danh sách truyện sách</h3>
        <a href="{{route('admin.comic.create')}}" class="btn btn-success">Thêm truyện <i class="fa fa-plus"></i></a>
        <hr>
        @if(session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th width="10%">Ảnh MH</th>
                    <th width="15%">Tiêu đề</th>
                    <th width="10%">SEO</th>
                    <th>Tác giả</th>
                    <th width="10%">Thể loại</th>
                    <th>Trạng thái</th>
                    <th>Thời gian thêm</th>
                    <th width="8%" class="text-center">Sửa</th>
                    <th width="8%" class="text-center">Xóa</th>
                </tr>
            </thead>

            <tbody>
                @if(!empty($list))
                    @foreach($list as $key => $comic)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><img src="{{asset('uploads/comic/'.$comic->image)}}" width="100%" ></td>
                    <td>{{$comic->title}}</td>
                    <td>{{$comic->seo}}</td>
                    <td>{{$comic->author}}</td>
                    <td>
                        @if(!empty($comic->categories))
                            @foreach($comic->categories as $cate)
                                - {{$cate->title}}<br/>
                            @endforeach
                        @endif
                    </td>
                    <td>{{$comic->created_at->diffForHumans()}}</td>
                    <td class="text-center">{!!($comic->status==0?'<span class="btn btn-danger">Không kích hoạt</span>':'<span class="btn btn-success">Kích hoạt</span>')!!}</td>
                    <td class="text-center"><a href="{{route('admin.comic.edit', $comic)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center"><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
                    @endforeach 
                @endif
            </tbody>
        </table>
    </div>
@endsection