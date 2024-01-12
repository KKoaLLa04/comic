@extends('layouts.layouts')

@section('title', 'Thêm chương truyện mới')

@section('content')
    <div class="container-fluid">
        <h3>Thêm chương truyện mới</h3>
        <a href="{{route('admin.chapter.index')}}" class="btn btn-danger"><i class="fa fa-angle-double-left"></i></a>
        <hr>
       
        @if($errors->any())
            <div class="alert alert-danger">Vui lòng kiểm tra lại giá trị nhập vào</div>
        @endif
        @if(session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <form action="{{route('admin.chapter.store')}}" method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input type="text" name="title" onkeyup="ChangeToSlug()" id="slug" placeholder="Tiêu đề chương truyện...." class="form-control" value="{{old('title')}}">
                        @error('title')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input type="text" name="slug" id="convert_slug" placeholder="Slug chương truyện...." class="form-control" value="{{old('slug')}}">
                        @error('slug')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="">Mô tả ngắn</label>
                    <textarea name="description" class="form-control editor">{{old('description')}}</textarea>
                    @error('description')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="0" {{old('status') == 0 ?'selected' :false}}>Không kích hoạt</option>
                            <option value="1" {{old('status') == 1 ?'selected' :false}}>Kích hoạt</option>
                        </select>
                        @error('status')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Bộ truyện</label>
                        <select name="comic_id" class="form-control">
                            <option value="0">--------Chọn bộ truyện--------</option>
                            @if(!empty($comic))
                                @foreach($comic as $key => $item)
                                    <option {{old('comic_id') == $item->id ? 'selected':false}} value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('comic_id')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="">Nội dung</label>
                    <textarea name="content" class="form-control editor">{{old('content')}}</textarea>
                    @error('content')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            @csrf
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div>
@endsection