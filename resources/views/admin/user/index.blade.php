@extends('admin.layout.default')
@section('title_area', 'Manage User')
@section('main_section')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<div class="content">
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('class')}}">{{Session::get("message")}}</div>
    @endif
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-border panel-info">
					<div class="panel-heading"><h3 class="panel-title">Manage User</h3></div>
                    <div class="panel-body">
                        <form action="{{ route('user.store', ['user_id' => $selected_info->id ?? null]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                            @if ($errors->any())
            				    <div class="alert alert-danger">
            				        <ul>
            				            @foreach ($errors->all() as $error)
            				                <li>{{ $error }}</li>
            				            @endforeach
            				        </ul>
            				    </div>
            				@endif

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Name</label><small class="req"> *</small>
                                        <input type="text" name="name" placeholder="Full Name..." class="form-control" value="{{ old('name') }}" required >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="phone">Mobile Number</label><small class="req"> *</small>
                                        <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number" class="form-control" required >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="username">Email</label><small class="req"> *</small>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="User Email..." autocomplete="off" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="password">Password</label><small class="req"> *</small>
                                        <input type="password" name="password" id="password" placeholder="Password..." autocomplete="off" class="form-control" required >
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="password">Confirm Password</label><small class="req"> *</small><a href="javascript:void(0)" id="password_text"><i class="fa fa-eye"></i></a>
                                        <input type="password" name="confirm_password" id="confirm_password" onkeyup="checkPass(); return false;" placeholder="Confirm Password..." class="form-control" required >
                                        <span id="confirmMessage" class="confirmMessage"></span>

                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="password">Address</label><small class="req"> *</small>
                                        <textarea name="address" class="form-control" required>{{ old('address')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="picture">Upload Photo </label>(<code>100x100 JPG PNG MAX 1000 KB</code>)
                                        <input data-max-file-size="1024K" data-allowed-file-extensions="jpg png jpeg" name="photo" type="file" class="form-control" id="picture">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group pull-left m-t-22 m-l-15 ">
                                        <button name="add_user" type="submit" class="btn btn-primary"><i class="md md-add m-r-5"></i>Add User</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col -->
        </div> <!-- End row -->

        <style>
            i.fa.fa-eye {
                position: relative;
                top: 33px;
                left: 180px;
            }
        </style>

        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 panel-body-table">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL.</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Contact</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allUsers as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    @if($value->photo)
                                                        <img src="{{ asset($value->photo) }}" height="100" width="100">
                                                    @else
                                                        <img src="{{ asset('admin/images/no-image.jpg') }}" height="100" width="100">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }} @if(logged_in_user_id() == $value->id) <span class="label label-default bg-light-success bg-success-color m-b-5 d-inline-block">(You)</span> @endif</td>
                                                <td>{{ $value->mobile }}-({{ $value->email }})</td>
                                                <td>{{ $value->address }}</td>
                                                <td>
                                                    <a onclick="return confirm('Are You Sure?')" href="{{ route('user.control',['user_id' => $value->id]) }}" title="{{ $value['status'] == 1 ? 'Enable' : 'Disable' }}" class="text-{{ $value['status'] == 1 ? 'success' : 'danger' }} btn btn-default btn-xs waves-effect tooltips" data-placement="top" data-toggle="tooltip"><i class="fa fa-check-circle"></i></a>

                                                    <a onclick="return confirm('Are You Sure?')" href="{{ route('user.destroy',['user_id' => $value->id]) }}" class="text-danger btn btn-default  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
    </div> <!-- container -->
</div>
<!--data table-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<!--data table-->
<script src="{{asset('admin/vendors/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/vendors/notifications/notify.min.js')}}"></script>
<script src="{{asset('admin/vendors/notifications/notify-metro.js')}}"></script>
<script src="{{asset('admin/vendors/notifications/notifications.js')}}"></script>
<script>
	$(document).ready(function() {
	    var table = $('#example').DataTable( {
	        lengthChange: false,
	        buttons: [ 'excel', 'pdf', 'colvis' ],
          "scrollX": true
	    } );

	    table.buttons().container()
	        .appendTo( '#example_wrapper .col-md-6:eq(0)' );

        $("#password_text").on("click",function(){
            var x = document.getElementById("confirm_password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });

	});

    function checkPass(){
        var password = document.getElementById('password');
        var con_password = document.getElementById('confirm_password');
        var message = document.getElementById('confirmMessage');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        if(password.value == con_password.value){
            con_password.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Congrates, Password Match !"
        }else{
            con_password.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Sorry, Password Does Not Match !"
        }
    }
</script>

<style>
/*
----------------------
 panel-body-table Css
----------------------
*/
.panel-body-table table tbody tr td:nth-child(2) {
    width: 12%;
}
.panel-body-table table tbody tr td:nth-child(4) {
    width: 17%;
}
</style>

@endsection