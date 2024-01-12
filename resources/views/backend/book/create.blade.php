@extends('layouts.layouts')

@section('title', 'Thêm sách đọc mới')

@section('content')
    <div class="container-fluid">
        <h3>Thêm sách đọc mới</h3>
        <a href="{{route('admin.book.index')}}" class="btn btn-danger"><i class="fa fa-angle-double-left"></i></a>
        <hr>
       
        @if($errors->any())
            <div class="alert alert-danger">Vui lòng kiểm tra lại giá trị nhập vào</div>
        @endif
        @if(session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <form action="{{route('admin.book.store')}}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input type="text" name="title" onkeyup="ChangeToSlug()" id="slug" placeholder="Tiêu đề sách đọc...." class="form-control" value="{{old('title')}}">
                        @error('title')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input type="text" name="slug" id="convert_slug" placeholder="Slug sách đọc...." class="form-control" value="{{old('slug')}}">
                        @error('slug')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="">Mô tả sách</label>
                    <textarea name="description" class="form-control editor" rows="5">{{old('description')}}</textarea>
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
                        <label for="">Từ khóa (SEO)</label>
                        <input type="text" class="form-control" name="seo" placeholder="Từ khóa (SEO)..." value="{{old('seo')}}">
                        @error('seo')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="">Nội dung sách</label>
                    <textarea name="content" class="form-control editor" rows="5">{{old('content')}}</textarea>
                    @error('content')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Ảnh minh họa</label>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            @csrf
            <br>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div>
@endsection