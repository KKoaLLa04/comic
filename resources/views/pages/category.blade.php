@extends('welcome')


@section('title', 'Trang Chủ - Thể Loại')

@section('content')
<main>
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-md-8 col-lg-9 mb-3">
                <div class="head-title-global d-flex justify-content-between mb-2">
                    <div class="col-12 col-md-12 col-lg-12 head-title-global__left d-flex">
                        <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                            <span href="#" class="d-block text-decoration-none text-dark fs-4 category-name"
                                title="{{$categoryDetail->title}}">{{$categoryDetail->title}}</span>
                        </h2>
                    </div>
                </div>

                @if(!empty($comicCate) && count($comicCate) > 0)
                <div class="list-story-in-category section-stories-hot__list">
                        @foreach($comicCate as $key => $comic)
                    <div class="story-item">
                        <a href="{{route('view_comic', ['slug' => $comic->slug])}}" class="d-block text-decoration-none">
                            <div class="story-item__image">
                                <img src="{{asset("uploads/comic/$comic->image")}}" alt="Tự Cẩm" class="img-fluid" width="150"
                                    height="230" loading="lazy">
                            </div>
                            <h3 class="story-item__name text-one-row story-name">{{$comic->title}}</h3>

                            <div class="list-badge">
                                {{-- <span class="story-item__badge badge text-bg-success">Full</span> --}}

                                <span
                                    class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>

                                <span
                                    class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>

                            </div>
                        </a>
                    </div>
                        @endforeach 
                </div>
                @else 
                    <div class="alert alert-danger text-center">Thể loại truyện đang cập nhật...</div>                    
                @endif
            </div>
            <div class="col-12 col-md-4 col-lg-3 sticky-md-top">
                <div class="category-description bg-light p-2 rounded mb-3 card-custom">
                    <p class="mb-0 text-secondary"></p>
                    <p>Truyện thuộc kiểu lãng mạn, kể về những sự kiện vui buồn trong tình yêu của nhân vật chính.
                    </p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection