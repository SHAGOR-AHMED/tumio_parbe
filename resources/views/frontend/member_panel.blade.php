@extends('frontend.layout.default')
@section('title_area','Student Login | Tumio Parbe')
@section('meta_title', 'Student Login | Tumio Parbe')
@section('meta_description', 'Tumio Parbe management has years of home improvement experience.')
@section('main_section')

    <section class="page-banner" style="min-height: 200px; position: relative; overflow: hidden; border-top:2px solid #fff;">
        <div class="page-banner-wrap">
            <div class="banner-bg inline-bg" style="background: url({{ asset('frontend/assets/images/footer-bg.png') }}); min-height: 200px;">
            </div>
        </div>
        <div class="all-page-heading">
            <div class="bnr-des">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="clearfix ulc">
                                <li class="delim"><a href="{{url('/')}}" title="Home">Home</a></li>
                                <li class="delim">Login</li>
                            </ul>
                            <h1 class="bnr-des-title">Login</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="panel-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="ad-shipping-form-wrp shadow-sm clearfix">
                        <div class="ad-shipping-form">
                            <br>
                            <h2 class="px-3">Login Here</h2>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="member-panel-form p-3">
                                <div class="member-panel-form-tbs">
                                    <form action="{{ url('student-login-check') }}" method="post">
                                        @csrf
                                        <div class="member-panel-form-fld">
                                            <label>Username</label>
                                            <input type="text" class='form-control' name="username" value="" placeholder="Enter Username" required>
                                            <span class="help-block" ></span>   
                                        </div> <br>
                                        <div class="member-panel-form-fld">
                                            <label>Password</label>
                                            <input type="password" class='form-control' name="password" value="" placeholder="Enter Password" required>
                                            <span class="help-block" ></span>   
                                        </div> <br>
                                        <button type="submit" class="btn btn-signup" value="submit">Submit</button>
                                        Didn't have account? <a href="{{ url('student-account-signup') }}">Sign Up here</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection