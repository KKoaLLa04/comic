<!DOCTYPE html>
<!-- saved from url=(0021)https://suustore.com/ -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">


    <!-- Bootstrap CSS v5.2.1 -->

    <link href="{{asset('client/bootstrap.min.css')}}" rel="stylesheet">

    {{-- <link rel="shortcut icon" href="https://suustore.com{{asset('client/frontend/images/favicon.ico" type="image/x-icon"> --}}
    <link rel="stylesheet" href="{{asset('client/app.css')}}">
    <link rel="stylesheet" href="{{asset('client/style.css')}}">

{{-- 
    <script>
        window.SuuTruyen = {
            baseUrl: 'https://suustore.com',
            urlCurrent: 'https://suustore.com',
            csrfToken: '4EebYu2rWivdRk1ET12dyuY0CJjpRERhJynPtvUy'
        }
    </script> --}}

    <title>@yield('title')</title>
    <meta name="description"
        content="Đọc truyện online, truyện hay. Demo Truyện luôn tổng hợp và cập nhật các chương truyện một cách nhanh nhất.">
</head>

<body>
    @include('pages.layouts.header')

    @include('pages.layouts.header_bottom')

    @yield('content')

    @include('pages.layouts.footer')

    <script src="{{asset('client/jquery.min.js')}}">
    </script>

    <script src="{{asset('client/popper.min.js')}}">
    </script>

    <script src="{{asset('client/bootstrap.min.js')}}">
    </script>



    <script src="{{asset('client/app.js')}}">
    </script>
    <script src="{{asset('client/common.js')}}"></script>



    <div id="loadingPage" class="loading-full">
        <div class="loading-full_icon">
            <div class="spinner-grow"><span class="visually-hidden">Loading...</span></div>
        </div>
    </div>

    <script>
         $('.select-chapter').on('change', function(){
            let url = $(this).val();

            if(url){
              window.location.href = url
            }

            return false
          })

          // search with ajax
          $('#keywords').keyup(function(){
            let keywords = $(this).val();

            if(keywords != ''){
              var _token = $('input[name="_token"]').val();

              $.ajax({
                url:"{{url('/search_ajax')}}",
                method: "POST",
                data:{keywords:keywords, _token:_token},
                success:function(data){
                  $('#search_ajax').fadeIn();
                  $('#search_ajax').html(data);
                }

              });

            }else{

              $('#search_ajax').fadeOut();
            }
          })

          $(document).on('click', '.li_search_ajax',function (){
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
          })

          // // tags outside
          $(function() {
            $('a').on('click', function() {
              return true;
            });
          });
    </script>

    {{-- Xử lý popup pdf --}}
    <script type="text/javascript">
        $(document).on('click', '.read_book',function(){
          var book_id = $(this).attr('id');
          var _token = $('input[name="_token"]').val();

          $.ajax({
            url:'{{url('/doc-sach-pdf')}}',
            method:"POST",
            dataType:"JSON",
            data:{book_id:book_id,_token:_token},
            success:function(data){
              $('#book_title').html(data.book_title);
              $('#book_content').html(data.book_content);
            }
          });
        });
    </script>

    {{-- facebook plugin comment --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0&appId=2020888608279352" nonce="hpiPdBpu"></script>

    {{-- link cdn version cũ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
    <script script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

    {{-- addthis --}}
    <div class="elfsight-app-de467a89-1b3b-46f1-a668-65d323fd7757" data-elfsight-app-lazy></div>
    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
</body>

</html>