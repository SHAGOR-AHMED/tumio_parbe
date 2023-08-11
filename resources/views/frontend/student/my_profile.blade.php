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
					@include('frontend.student.sidemenu')
                </div>
			</div>
			<div class="col-lg-6 welcome-right mt-lg-0 mt-5" style="border:1px solid #e2e2e2;">
				<div class="panel panel-info" style="padding: 5px;">
				    <div class="panel-heading" style="background: #2DA2BF; color: #fff;padding: 10px; text-align: center; text-transform: uppercase;">
				        My Profile
				    </div>
				    
				    <div class="panel-body">
				        <form class="form-vertical" action="{{ url('update-profile') }}" method="post" enctype="multipart/form-data">
				        @csrf
				        <br>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Full Name <span style="color:#DC3545">*</span></label>
										<input  type="text" value="<?= $selected_info->full_name; ?>" name="full_name" class="form-control" placeholder="Enter your full name" required>
										<span class="error text-danger"> {{ $errors->first('full_name') }} </span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Father Name <span style="color:#DC3545">*</span></label>
										<input  type="text" value="<?= $selected_info->father_name; ?>" name="father_name" class="form-control" placeholder="Enter your father name" required>
										<span class="error text-danger"> {{ $errors->first('father_name') }} </span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Mother Name <span style="color:#DC3545">*</span></label>
										<input  type="text" value="<?= $selected_info->mother_name; ?>" name="mother_name" class="form-control" placeholder="Enter your mother name" required>
										<span class="error text-danger"> {{ $errors->first('mother_name') }} </span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Mobile No <span style="color:#DC3545">*</span></label>
										<input  type="text" value="<?= $selected_info->phone; ?>" name="phone" class="form-control" placeholder="Enter your mobile number" required>
										<span class="error text-danger"> {{ $errors->first('phone') }} </span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email</label>
				                		<input  type="email" value="<?= $selected_info->email; ?>" name="email" class="form-control" placeholder="Enter your E-mail">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Age <span style="color:#DC3545">*</span></label>
										<input  type="text" value="<?= $selected_info->age; ?>" name="age" class="form-control" placeholder="Enter your age" required>
										<span class="error text-danger"> {{ $errors->first('age') }} </span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Grade <span style="color:#DC3545">*</span></label>
				                		<input  type="text" value="<?= $selected_info->grade; ?>" name="grade" class="form-control" placeholder="Enter Grade" required>
										<span class="error text-danger"> {{ $errors->first('grade') }} </span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>School</label>
										<input type="text" value="<?= $selected_info->school; ?>" name="school" class="form-control" placeholder="Enter your school">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">District <span style="color:#DC3545">*</span></label>
				                		<input  type="text" value="<?= $selected_info->district; ?>" name="district" class="form-control" placeholder="Enter district" required>
										<span class="error text-danger"> {{ $errors->first('district') }} </span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Fb Link</label>
										<input  type="text" value="<?= $selected_info->fb_link; ?>" name="fb_link" class="form-control" placeholder="Enter your facebook link" required>
										<span class="error text-danger"> {{ $errors->first('fb_link') }} </span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="email">Address</label>
										<textarea class="form-control" name="address" required><?= $selected_info->address; ?></textarea>
										<span class="error text-danger"> {{ $errors->first('address') }} </span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										@if($selected_info->photo)
											<img src="{{ asset($selected_info->photo) }}" height="100" width="100"/>
										@endif
										<label>Upload Photo</label>
                          				<input type="file" name="photo" value="" class="form-control mb-1" />
                          				<code><i class="fa fa-circle-exclamation"></i> Max 1MB</code>
									</div>
								</div>
							</div>

				            <input  type="hidden" value="<?= $selected_info->id; ?>" name="id" class="form-control">

				            <div class="form-group">
				                <button class="btn btn-success" type="submit" name="login">Update</button>
				            </div>
				        </form> 
				    </div>
				</div> 
			</div>
			<div class="col-lg-3 welcome-right mt-lg-0 mt-5" style="border:1px solid #e2e2e2;">
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
								<span class="error text-danger"> {{ $errors->first('password') }} </span>
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