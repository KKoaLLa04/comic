@extends('welcome')


@section('title', 'Trang Chủ - Đọc truyện')

@section('content')
<main>
    <div class="chapter-wrapper container my-5">
        <a href="#" class="text-decoration-none">
            <h1 class="text-center text-success">{{$chapter->comic->title}}</h1>
        </a>
        <a href="#" class="text-decoration-none">
            <p class="text-center text-dark">{{$chapter->title}}</p>
        </a>
        <hr class="chapter-start container-fluid">
        <div class="chapter-nav text-center">
            @if($chapter->id > $min_id->id)
            <a class="btn btn-success me-1 chapter-prev"
                href="{{route('read_comic', ['slug' => $pre_chapter->slug])}}" title=""> <span>Chương
                </span>trước</a>
            @endif
            <select name="chapter" id="" class="btn btn-danger me-1 chapter-prev select-chapter">
                @if(!empty($allChapter))
                    @foreach($allChapter as $key => $chap)
                        <option value="{{route('read_comic', ['slug' => $chap->slug])}}" {{$chapter->id==$chap->id?'selected':false}}>
                            {{$chap->title}}
                        </option>
                    @endforeach
                @endif
            </select>
            @if($chapter->id < $max_id->id)
            <a class="btn btn-success chapter-next"
                href="{{route('read_comic', ['slug' => $next_chapter->slug])}}" title=""><span>Chương
                </span>tiếp</a>
            @endif
        </div>
        <hr class="chapter-end container-fluid">


        <div class="chapter-content mb-3">
            
            {!!$chapter->content!!}
        </div>

        <div class="text-center px-2 py-2 alert alert-success d-none d-lg-block" role="alert">Bạn có thể dùng phím
            mũi tên hoặc WASD để
            lùi/sang chương</div>
    </div>

    {{-- <div class="chapter-actions chapter-actions-mobile d-flex align-items-center justify-content-center">
        <a class="btn btn-success me-2 chapter-prev"
            href="#" title=""> <span>Chương
            </span>trước</a>
        <button class="btn btn-success chapter_jump me-2" data-story-id="3" data-slug-chapter="chuong-1"
            data-slug-story="nang-khong-muon-lam-hoang-hau"><span>

                <svg style="fill: #fff;" xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z">
                    </path>
                </svg>
            </span></button>

        <div class="dropup select-chapter me-2 d-none">
            <a class="btn btn-secondary dropdown-toggle" role="button"
                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Chọn chương
            </a>

            <ul class="dropdown-menu select-chapter__list" aria-labelledby="dropdownMenuLink">

            </ul>
        </div>
        <a class="btn btn-success chapter-next" href="#"
            title=""><span>Chương </span>tiếp</a>
    </div> --}}
        <div class="chapter-nav text-center" style="position: fixed; bottom: 5px; left:50%;transform: translateX(-50%);">
            @if($chapter->id > $min_id->id)
            <a class="btn btn-success me-1 chapter-prev"
                href="{{route('read_comic', ['slug' => $pre_chapter->slug])}}" title=""> <span>Chương
                </span>trước</a>
            @endif
            <select name="chapter" id="" class="btn btn-danger me-1 chapter-prev select-chapter">
                @if(!empty($allChapter))
                    @foreach($allChapter as $key => $chap)
                        <option value="{{route('read_comic', ['slug' => $chap->slug])}}" {{$chapter->id==$chap->id?'selected':false}}>
                            {{$chap->title}}
                        </option>
                    @endforeach
                @endif
            </select>
            @if($chapter->id < $max_id->id)
            <a class="btn btn-success chapter-next"
                href="{{route('read_comic', ['slug' => $next_chapter->slug])}}" title=""><span>Chương
                </span>tiếp</a>
            @endif
        </div>

    <div class="container">
        <h3>Lưu truyện và chia sẻ:</h3>
        <div class="fb-share-button" data-href="{{URL::current()}}" data-layout="" data-size="large"><a target="_blank" href="{{URL::current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
        
        <div class="mt-5"></div>
        <div class="fb-comments" data-href="{{URL::current()}}" data-width="100%" data-numposts="100"></div>

        <h3 class="mt-5">Truyện mới</h3>
        @if(!empty($comicLatest) && count($comicLatest) > 0)
                <div class="list-story-in-category section-stories-hot__list">
                        @foreach($comicLatest as $key => $comic)
                    <div class="story-item">
                        <a href="{{route('view_comic', ['slug'=>$comic->slug])}}" class="d-block text-decoration-none">
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
</main>
@endsection