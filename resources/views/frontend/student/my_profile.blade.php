@extends('frontend.layout.default')
@section('title_area', 'My Profile')
@section('main_section')
<div class="welcome py-5" id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p style="background: #2da2bf; color: #fff; font-size: 18px; text-align: center;padding: 10px; text-transform: uppercase;">My Dashboard</p>
				@if(Session::has('message'))
                    <div class="alert alert-{{Session::get('class')}}">{{Session::get("message")}}</div>
                @endif
			</div>
		</div>
		<div class="row py-xl-4">
			<div class="col-lg-3 welcome-left pr-lg-5" style="border:1px solid #e2e2e2;padding: 10px;">
				<div style="border:1px dotted #e2e2e2;padding: 10px;">
					<?php
                        $studentId = Session::get('studentId');
                    ?>
                    <ul style="list-style: none;line-height: 40px;">
                        <li style="background-color: #e2e2e2; text-align: center;margin:5px;"><a href="{{ url('my-account') }}" title="Dashboard">Dashboard</a></li>
                        <li style="background-color: #e2e2e2; text-align: center;margin:5px;"><a href="{{ url('my-order/'.encrypt($studentId)) }}" title="My Order">My Course</a></li>
                        <li style="background-color: #e2e2e2; text-align: center; margin:5px;"><a href="{{ url('edit-my-profile/'.encrypt($studentId)) }}" title="My Profile">My Profile</a></li>
                    </ul>
                </div>
			</div>
			<div class="col-lg-5 welcome-right mt-lg-0 mt-5" style="border:1px solid #e2e2e2;">
				<div class="panel panel-info" style="padding: 5px;">
				    <div class="panel-heading" style="background: #2DA2BF; color: #fff;padding: 10px; text-align: center; text-transform: uppercase;">
				        My Profile
				    </div>
				    
				    <div class="panel-body">
				        <form class="form-vertical" action="{{ url('update-profile') }}" method="post">
				        @csrf
				        	<br>
				            <div class="form-group">
				                <label for="email"> Full Name</label>
				                <input  type="text" value="<?= $selected_info->full_name; ?>" name="full_name" class="form-control" placeholder="Enter your full name" required>
				            </div>

				            <div class="form-group">
				                <label for="email">Mobile No</label>
				                <input  type="text" value="<?= $selected_info->phone; ?>" name="phone" class="form-control" placeholder="Enter your mobile number" required>
				            </div>

				            <div class="form-group">
				                <label for="email">Email</label>
				                <input  type="email" value="<?= $selected_info->email; ?>" name="email" class="form-control" placeholder="Enter your E-mail">
				            </div>

				            <div class="form-group">
				                <label for="email">Address</label>
				                <textarea class="form-control" name="address"><?= $selected_info->address; ?></textarea>
				            </div>

				            <input  type="hidden" value="<?= $selected_info->id; ?>" name="id" class="form-control">

				            <div class="form-group">
				                <button class="btn btn-success" type="submit" name="login">Update</button>
				            </div>
				        </form> 
				    </div>
				</div> 
			</div>
			<div class="col-lg-4 welcome-right mt-lg-0 mt-5" style="border:1px solid #e2e2e2;">
				<div class="panel panel-info" style="padding: 5px;">
				    <div class="panel-heading" style="background: #2DA2BF; color: #fff;padding: 10px; text-align: center; text-transform: uppercase;">
				        Change Password
				    </div>
				    
				    <div class="panel-body">
				        <form class="form-vertical" action="{{ url('update-profile') }}" method="post">
				        @csrf
				        	<br>
				            
				            <div class="form-group">
				                <label for="email">New Password</label>
				                <input  type="text" value="" name="password" class="form-control" placeholder="Enter your new password" required>
				            </div>

				            <input  type="hidden" value="<?= $selected_info->id; ?>" name="id" class="form-control">

				            <div class="form-group">
				                <button class="btn btn-success" type="submit" name="login">Update</button>
				            </div>
				        </form> 
				    </div>
				</div> 
			</div>
		</div>
	</div>
</div>
@endsection