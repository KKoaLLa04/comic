@extends('layouts.layouts')

@section('title', 'Cập nhật truyện sách')

@section('content')
    <div class="container-fluid">
        <h3>Cập nhật truyện sách</h3>
        <a href="{{route('admin.comic.index')}}" class="btn btn-danger"><i class="fa fa-angle-double-left"></i></a>
        <hr>
       
        @if($errors->any())
            <div class="alert alert-danger">Vui lòng kiểm tra lại giá trị nhập vào</div>
        @endif

        @if(session('msg'))
            <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <form action="{{route('admin.comic.update', $comicDetail)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input type="text" name="title" onkeyup="ChangeToSlug()" id="slug" placeholder="Tiêu đề truyện...." class="form-control" value="{{old('title') ?? $comicDetail->title}}">
                        @error('title')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input type="text" name="slug" id="convert_slug" placeholder="Slug truyện...." class="form-control" value="{{old('slug') ?? $comicDetail->slug}}">
                        @error('slug')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">Mô tả</label>
                       <textarea name="description" class="form-control editor" rows="3">{{old('description') ?? $comicDetail->description}}</textarea>
                        @error('description')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="0" {{old('status') == 0 || $comicDetail->status==0 ?'selected' :false}}>Không kích hoạt</option>
                            <option value="1" {{old('status') == 1 || $comicDetail->status==1 ?'selected' :false}}>Kích hoạt</option>
                        </select>
                        @error('status')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Từ khóa (SEO)</label>
                        <input type="text" name="seo" placeholder="Từ khóa (SEO)...." class="form-control" value="{{old('seo') ?? $comicDetail->seo}}">
                        @error('seo')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tác giả</label>
                        <input type="text" name="author" placeholder="Tác giả...." class="form-control" value="{{old('author') ?? $comicDetail->author}}">
                        @error('author')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Ảnh (Bỏ qua nếu không đổi)</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <label for="">Thể loại</label>
                    <div class="form-group">
                        @if(!empty($category))
                            @foreach($category as $key => $cate)
                                <input type="checkbox" {{ (!empty($cateArr[$cate->id]) && $cateArr[$cate->id]==$cate->id)?'checked':false}}  value="{{$cate->id}}" id="category_{{$cate->id}}" name="category[]" > <label for="category_{{$cate->id}}">{{$cate->title}}</label> <br>
                            @endforeach 
                            @error('category')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        @endif
                    </div>
                </div>

                <div class="col-2">
                    <label for="">Ảnh minh họa</label>
                    <img src="{{asset('uploads/comic/'.$comicDetail->image)}}" width="100%" >
                </div>
            </div>

            @csrf
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection