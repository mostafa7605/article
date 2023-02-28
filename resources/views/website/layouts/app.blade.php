<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('website.layouts.meta')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pagination.css') }}" />
    
    
</head>

    <body id="body">

        @include('website.layouts.header')
        @yield('content')
        @include('website.layouts.footer')


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script>
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                asNavFor: '.slider-nav',
                dots:true,
                nextArrow: '<button class="slide-arrow next-arrow"><img src="{{ asset('assets/img/right-arrow.png')}}" /></button>'
            });
            $('.slider-nav').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: false,
                focusOnSelect: true,
                fade: true,
                nextArrow: '<button class="slide-arrow next-arrow arrow-right"><img src="{{ asset('assets/img/right-arrow.png')}}" /></button>'
            });
            setInterval(function(){
                var number = $('.slick-dots li').length;
                var counter = null;
                for(var i = 0; i< number;i++){ 
                    if($('.slick-dots li').eq(i).hasClass('slick-active')){ counter=i+1; } 
                }
                $('.counter').text(counter);
            },100);
        </script>
        <script>
              function bookmark(article_id,purchase_type) {
                let element= document.getElementById('image_bookmark'+article_id);
                if(purchase_type=='dark'){
                    if (element.className == "marked") {
                      element.className = "not_marked";
                      element.src="{{ asset('assets/img/bookmark.svg ') }}"
                    } else {
                      element.className = "marked";
                       element.src="{{ asset('assets/img/bookmark_fill.svg ') }}"
                    }
                }else if(purchase_type=='light'){
                     if (element.className == "marked") {
                      element.className = "not_marked";
                      element.src="{{ asset('assets/img/bookmark_white.svg ') }}"
                    } else {
                      element.className = "marked";
                       element.src="{{ asset('assets/img/bookmark_white_fill.svg ') }}"
                    }
                }

                 $.ajax({ 
                type: 'GET',
                url: '/bookmark/' + article_id,
                success: function(data) {

                }
            });
              }
            function following(id){
                $.ajax({
                type: 'GET',
                url: '/follow_user/' + id,
                success: function(res) {
                     document.getElementById('follow_link_'+id).innerHTML=res.message;
                       document.getElementById('follower_span_'+id).innerHTML=res.count;
                     },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
            }
            // $(window).scroll(function(){
            //     if ($(this).scrollTop() > 120) {
            //         $('header').addClass('fixed');
            //     } else {
            //         $('header').removeClass('fixed');
            //     }
            // });


            
        </script>
        @stack('scripts')

    </body>    
</html>