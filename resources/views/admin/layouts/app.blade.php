<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> R-write</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('/assets/img/logo/logo.svg') }}" type="image/x-icon">
    <!-- simplebar CSS-->
    <link href="{!! asset('/rwrite/assets/plugins/simplebar/css/simplebar.css') !!}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{!! asset('/rwrite/assets/css/bootstrap.min.css') !!}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{!! asset('/rwrite/assets/css/animate.css') !!}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{!! asset('/rwrite/assets/css/icons.css') !!}" rel="stylesheet" type="text/css" />
    <!-- Horizontal menu CSS-->
    <!-- <link href="{!! asset('/rwrite/assets/css/horizontal-menu.css') !!}" rel="stylesheet"/> -->
    <!-- Custom Style-->
    <!-- <link href="{!! asset('/rwrite/assets/css/app-style.css') !!}" rel="stylesheet"/> -->
    <link href="{!! asset('/rwrite/assets/css/admin/style.css') !!}" rel="stylesheet" />
    <link href="{!! asset('/v2/css/pagination.css') !!}" rel="stylesheet" />


    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>


    <style>

    </style>
</head>

<body class="d-flex flex-column min-vh-100">


    @include('admin.layouts.sidebar')



    <!-- Start wrapper-->
    <div id="wrapper">

        <!-- start loader -->
        <div id="pageloader-overlay" class="visible incoming">
            <div class="loader-wrapper-outer">
                <div class="loader-wrapper-inner">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
        <!-- end loader -->

        <!--Start topbar header-->
        @include('admin.layouts.header')
        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container">
                @yield('content')
                <!--start overlay-->
                <div class="overlay toggle-menu">
                </div>
                <!--end overlay-->
            </div>
            <!-- End container-fluid-->
        </div>
        <!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
    </div>
    <!--End wrapper-->

    @include('admin.layouts.footer')


    <!-- Bootstrap core JavaScript-->
    <script src="{!! asset('/rwrite/assets/js/jquery.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/js/popper.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/js/bootstrap.min.js') !!}"></script>

    <!-- simplebar js -->
    <script src="{!! asset('/rwrite/assets/plugins/simplebar/js/simplebar.js') !!}"></script>
    <!-- horizontal-menu js -->
    <script src="{!! asset('/rwrite/assets/js/horizontal-menu.js') !!}"></script>

    <!-- Custom scripts -->
    <script src="{!! asset('/rwrite/assets/js/app-script.js') !!}"></script>

    <!-- Easy Pie Chart JS -->
    <script src="{!! asset('/rwrite/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') !!}"></script>
    <!-- Chart JS -->
    <script src="{!! asset('/rwrite/assets/plugins/Chart.js/Chart.min.js') !!}"></script>

    <!-- Custom scripts -->
    <!-- <script src="{!! asset('/rwrite/assets/js/dashboard-logistics.js') !!}"></script> -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <!-- firebase config -->

    <!-- datatabe links -->
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/jszip.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/pdfmake.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/vfs_fonts.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js') !!}"></script>
    <script src="{!! asset('/rwrite/assets/plugins/jquery-validation/js/jquery.validate.min.js') !!}"></script>

    @yield('scripts')

    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.lang.en.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#role-span').popover({
                html: true,
                trigger: 'click',
                template: '<div class="popover role-open" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                content: function() {
                    return $('#role-popover-content').html();
                }
            })


        });
    </script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "202px";
            $('#toogleMenu').css({
                'left': '99px',
                'transition': '0.5s'
            })
            $('#main_logo').css({
                'transform': 'scale(1.8) translate(-71px, 20px)',
                'z-index': '999'
            });
            $('#closebtn img').css('right', '-540px');
            $('.media-left').css('flex-direction', 'row-reverse');
            $('#burger_icon').css({
                'left': 'auto',
                'right': '41px'
            })
            $('#burger_icon').attr('src', 'http://127.0.0.1:8000/rwrite/assets/images/admin/homepage/Group 463.svg')
            $('#toogleMenu').attr('onclick', 'closeNav()');
            $('#close_img').css('opacity', '0')
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            $('#toogleMenu').css('left', '0px')
            $('#main_logo').css({
                'transform': 'scale(1)',
                'transform': 'translate(0px, 0px)'
            });
            $('.media-left').css('flex-direction', 'inherit');
            $('#burger_icon').attr('src', 'http://127.0.0.1:8000/rwrite/assets/images/admin/homepage/Group 341.svg')
            $('#toogleMenu').attr('onclick', 'openNav()');
            $('#burger_icon').css({
                'left': '30px',
                'right': 'auto'
            })
            $('#close_img').css('opacity', '1')


        }
    </script>
</body>

</html>
