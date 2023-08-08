<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{config('app.site_name')}}">
        <meta name="author" content="{{config('app.site_name')}}">
        <meta name="_token" content="{{csrf_token()}}" />
        <link rel="shortcut icon" href="{{asset('admin/images/icon.png')}}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <title>@yield('title_area')</title>

        <!-- Font Icons new adding  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ionicons/6.0.2/esm/ionicons.min.js" ></script>
        <link href="{{asset('admin/vendors/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/css/material-design-iconic-font.min.css')}}" rel="stylesheet">

        <!-- Base Css Files -->
        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/css/bootstrap-select.min.css')}}" rel="stylesheet" />

        <!-- animate css -->
        <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="{{asset('admin/css/waves-effect.css')}}" rel="stylesheet">
        <!-- Plugins css-->
        <link href="{{asset('admin/vendors/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/vendors/timepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/vendors/notifications/notification.css')}}" rel="stylesheet" />
        <!-- for data table -->
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" media="all"/>
        <!-- for sweetalert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
        <!--calendar css-->
        <link href="{{asset('admin/vendors/jquery-multi-select/multi-select.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('admin/vendors/dropify-master/dist/css/dropify.min.css')}}">

        <!-- Custom Files -->
        <link href="{{asset('admin/css/helper.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet" type="text/css" />
        <!-- new add -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
        <!-- new add -->
        <!-- jQuery  -->
        <script src="{{asset('admin/js/jquery.min.js')}}"></script>
        <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin/js/modernizr.min.js')}}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>

    </head>

    <body class="fixed-left">
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            @include('admin.layout.header')
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.layout.sidebar')
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                @yield('main_section')
                <!-- content end-->
                @include('admin.layout.footer')
            </div>
        </div>
        <!-- END wrapper -->
        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery  -->
        <script src="{{asset('admin/js/waves.js')}}"></script>
        <script src="{{asset('admin/js/wow.min.js')}}"></script>
        <script src="{{asset('admin/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin/js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{asset('admin/vendors/jquery-detectmobile/detect.js')}}"></script>
        <script src="{{asset('admin/vendors/fastclick/fastclick.js')}}"></script>
        <script src="{{asset('admin/vendors/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

        <!-- for data table -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

        <!-- for sweetalert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Counter-up -->
        <script src="{{asset('admin/vendors/counterup/waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin/vendors/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>

        <!-- CUSTOM JS -->
        <script src="{{asset('admin/js/jquery.app.js')}}"></script>
        <script src="{{asset('admin/js/bootstrap-select.min.js')}}"></script>

        <script src="{{asset('admin/vendors/dropify-master/dist/js/dropify.min.js')}}"></script>
        <!-- Dashboard -->
        <!-- <script src="{{asset('admin')}}/jquery.dashboard.js"></script> -->
        <!-- Export Exeel js -->
        <script src="{{asset('admin/js/export.js')}}"></script>
        <script type="text/javascript">
            /* ==============================================
                Counter Up
                =============================================== */
            jQuery(document).ready(function($) {
                $(".counter").counterUp({
                    delay: 100,
                    time: 1200
                });
                $(':file').dropify();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTable').DataTable();
            } );
        </script>

    </body>
</html>