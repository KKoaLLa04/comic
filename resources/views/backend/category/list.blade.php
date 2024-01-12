@extends('layouts.layouts')

@section('title', 'Danh sách thể loại')

@section('content')
    <div class="container-fluid">
        <h3>Danh sách thể loại</h3>
        <a href="{{route('admin.category.create')}}" class="btn btn-success">Thêm thể loại <i class="fa fa-plus"></i></a>
        <hr>
        @if(session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th>Tiêu đề</th>
                    <th>slug</th>
                    <th>Ngày thêm</th>
                    <th width="15%">Trạng thái</th>
                    <th width="8%" class="text-center">Sửa</th>
                    <th width="8%" class="text-center">Xóa</th>
                </tr>
            </thead>

            <tbody>
                @if(!empty($list))
                    @foreach($list as $key => $cate)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$cate->title}}</td>
                    <td>{{$cate->slug}}</td>
                    <td>{{$cate->created_at->diffForHumans()}}</td>
                    <td class="text-center">{!!($cate->status==0?'<span class="btn btn-danger">Không kích hoạt</span>':'<span class="btn btn-success">Kích hoạt</span>')!!}</td>
                    <td class="text-center"><a href="{{route('admin.category.edit', $cate)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center"><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
                    @endforeach 
                @endif
            </tbody>
        </table>
    </div>
@endsection