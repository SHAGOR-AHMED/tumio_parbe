@extends('frontend.layout.default')
@section('title_area', 'Our Courses')
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
			<div class="col-lg-9" style="border:1px solid #e2e2e2;">
				<table id="myTable" border="1" class="table table-striped table-bordered" style="width:100%">
	                <thead>
	                    <tr>
	                        <th>SN</th>
	                        <th>Course Name</th>
	                        <th>Description</th>
	                        <th>Admission Fee</th>
	                        <th>Monthly Tuition Fee</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @foreach($get_all as $key => $val)
		                    <tr>
		                        <td>{{ ++$key }}</td>
		                        <td class="center">{{ $val->course_name }}</td>
		                        <td class="center">{{ $val->description }}</td>
		                        <td class="center">BDT {{ number_format($val->admission_fee, 2) }}</td>
		                        <td class="center">BDT {{ number_format($val->monthly_tuition_fee, 2) }}</td>
		                    </tr>
	                    @endforeach
	                </tbody>
	            </table>
			</div>
		</div>
	</div>
</div>

@endsection