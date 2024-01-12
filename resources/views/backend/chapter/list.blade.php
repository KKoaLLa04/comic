@extends('layouts.layouts')

@section('title', 'Danh sách thể loại')

@section('content')
    <div class="container-fluid">
        <h3>Danh sách chương truyện</h3>
        <a href="{{route('admin.chapter.create')}}" class="btn btn-success">Thêm chương truyện <i class="fa fa-plus"></i></a>
        <hr>
        @if(session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th>Tiêu đề</th>
                    <th width="40%">Mô tả</th>
                    <th>Thời gian</th>
                    <th>Bộ truyện</th>
                    <th width="15%">Trạng thái</th>
                    <th width="8%" class="text-center">Sửa</th>
                    <th width="8%" class="text-center">Xóa</th>
                </tr>
            </thead>

            <tbody>
                @if(!empty($list))
                    @foreach($list as $key => $chapter)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$chapter->title}}</td>
                    <td>{!!$chapter->description!!}</td>
                    <td>{{$chapter->created_at->diffForHumans()}}</td>
                    <td>{{$chapter->comic->title}}</td>
                    <td class="text-center">{!!($chapter->status==0?'<span class="btn btn-danger">Không kích hoạt</span>':'<span class="btn btn-success">Kích hoạt</span>')!!}</td>
                    <td class="text-center"><a href="{{route('admin.chapter.edit', $chapter)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center"><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
                    @endforeach 
                @endif
            </tbody>
        </table>
    </div>
@endsection