@extends('admin.layout.default')
@section('title_area')
    My Dashboard
@endsection
@section('main_section')
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="im-top-das m-b-20 bx-shadow">
                        <h4 class="pull-left page-title">Welcome To Seller Center</h4>
                        <ol class="breadcrumb pull-right m-0">
                            <li><a href="#">Admin</a></li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
              
                <div class="col-md-3 col-sm-6 col-lg-3">
                    <div class="mini-stat bg-light-danger clearfix bx-shadow">
                        <a href="#">
                            <span class="mini-stat-icon bg-danger m-0">
                                <img src="{{ asset('admin/images/taka.png') }}" style="margin-top: -4px;" />
                            </span>
                            <div class="mini-stat-info text-right">
                                <span class="bg-danger-color">2134534</span>
                                Total Revenue
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6 col-lg-3">
                    <div class="mini-stat bg-light-primary clearfix bx-shadow">
                        <a href="#" target="_blank">
                            <span class="mini-stat-icon bg-primary m-0">
                                <img src="{{ asset('admin/images/taka.png') }}" style="margin-top: -4px;" />
                            </span>
                            <div class="mini-stat-info text-right">
                                <span class="bg-primary-color">121</span>
                                Total Due
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3">
                    <div class="mini-stat bg-light-primary clearfix bx-shadow">
                        <a href="#"><span class="mini-stat-icon bg-primary m-0"><i
                                    class="fa fa-user" aria-hidden="true"></i></span>
                            <div class="mini-stat-info text-right">
                                <span class="bg-primary-color">5645</span>
                                Total Students's
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3">
                    <div class="mini-stat bg-light-success clearfix bx-shadow">
                        <a href="#"><span class="mini-stat-icon bg-success m-0"><i
                                    class="fa fa-cart-plus" aria-hidden="true"></i></span>
                            <div class="mini-stat-info text-right">
                                <span class="bg-success-color">546456</span>
                                Today Course's
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-lg-3">
                    <div class="mini-stat bg-light-warning clearfix bx-shadow">
                        <a href="#"><span class="mini-stat-icon bg-warning m-0"><i
                                    class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>
                            <div class="mini-stat-info text-right">
                                <span class="bg-warning-color">564564</span>
                                Total Batch's
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>
        </div> <!-- container -->
    </div>
@endsection
