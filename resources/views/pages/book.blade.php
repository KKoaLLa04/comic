@extends('welcome')


@section('title', 'Trang Chủ - Sách Đọc')

@section('content')
<main>
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-md-8 col-lg-9 mb-3">
                <div class="head-title-global d-flex justify-content-between mb-2">
                    <div class="col-12 col-md-12 col-lg-12 head-title-global__left d-flex">
                        <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                            <span href="#" class="d-block text-decoration-none text-dark fs-4 category-name"
                                title="">SÁCH ĐỌC</span>
                        </h2>
                    </div>
                </div>

                <div class="section-stories-hot__list">

                    @if(!empty($list))
                        @foreach($list as $key => $book)
                            <div class="story-item">
                                <a href="#" class="d-block text-decoration-none">
                                    <div class="story-item__image">
                                        <img src="{{asset("uploads/book/$book->image")}}" alt="{{$book->seo}}" class="img-fluid" width="150"
                                            height="230" loading="lazy">
                                    </div>
                                    <h3 class="story-item__name text-one-row story-name">{{$book->title}}</h3>

                                    <div class="list-badge">
                                        {{-- <span class="story-item__badge badge text-bg-success">Full</span> --}}

                                        <span
                                            class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>

                                        <span
                                            class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>

                                    </div>
                                </a>

                                <form>
                                    @csrf
                                    <!-- Button trigger modal -->
                                        <button type="button" id="{{$book->id}}" class="btn btn-danger btn-sm mt-1 form-control read_book" data-toggle="modal" data-target="#exampleModal">
                                            ĐỌC NGAY
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            <div id="book_title"></div>
                                                        </h5>
                                                        <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="book_content"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        @endforeach 
                    @else 
                        <div class="alert alert-danger text-center">Thể loại truyện đang cập nhật...</div>                    
                    @endif
                </div>
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