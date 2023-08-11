<!DOCTYPE html>
<html>

<head>
    @php $css_rand=rand(111,999); @endphp
    <title>@yield('title_area')</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="title" content="@yield('meta_title')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="description" content="@yield('meta_description')">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="{{asset('admin/images/icon.png')}}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/fonts/font-awesome/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/fancybox3/dist/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/slick.slider/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/slick.slider/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/fonts/custom-fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/assets/style.css?v={{ $css_rand }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <!-- for jquery -->
    <script src="{{asset('frontend/assets/js/jquery-3.6.1.min.js')}}"></script>
    <!-- for toastr -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/toastr.min.css') }}">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.min.css"/>
</head>
<body>

<header class="header">
  <div class="header-top" style="border-bottom:2px solid #fff;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="header-tp-inr clearfix">
            <div class="hdr-language-lft">
               <div class="hdr-language clearfix">
                  <a href="{{ url('/') }}" title="Logo">
                    <img src="{{ asset('admin/images/LogoTumioParbe.png') }}" alt="logo" height="60" width="60"/>
                  </a>
                </div>
            </div>
            <div class="header-tp-mid">
              <p style="cursor: pointer;"> “We build and brand” </p>
            </div>
            <div class="hdr-tp-rgt">
                <div class="hdr-login">
                  <?php
                      $studentId = Session('studentId');
                      if($studentId){ ?>
                            <div class="text-white">
                                Hello, <a href="{{ url('my-account') }}" class="text-capitalize" title="{{ Session::get('student_name') }}"><b>{{ Session::get('student_name') }}</b></a> <a href="{{ url('student-logout') }}"title="Logout"> / Logout</a>
                            </div>
                      <?php }else{ ?>
                          <a href="{{ url('member-panel') }}" title="Sign In"><i><img src="{{ asset('frontend/assets/images/singin-icon.png') }}" alt="singin-icon" /></i>SIGN IN</a>
                    <?php }  ?>
                </div>
            </div>
          </div>

        </div>
      </div>
   </div>
  </div>
</header>

@yield('main_section')
    
@include('frontend.layout.footer')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/smoothness/jquery-ui.min.css') }}" rel="stylesheet">
<script src="{{asset('frontend/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/sweetalert2.all.js')}}"></script>

</body>
</html>