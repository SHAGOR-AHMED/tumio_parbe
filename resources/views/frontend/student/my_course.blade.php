@extends('frontend.layout.default')
@section('title_area', 'My Course')
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
			<div class="col-lg-9" style="border:1px solid #e2e2e2; padding:5px;">
                <p>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#courseEnrollModal">Enroll New Course</button>
                </p>
				<table id="myTable" border="1" class="table table-striped table-bordered" style="width:100%">
	                <thead>
	                    <tr>
	                        <th>SN</th>
	                        <th>Course</th>
	                        <th>Batch</th>
	                        <th>Admission Fee</th>
	                        <th>FB Group Link</th>
	                        <th>Enroll Date</th>
	                    </tr>
	                </thead>
	                <tbody>
                        @isset($selected_info)
                            @foreach($selected_info as $key => $val)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td class="center">{{ $val->course_name }}</td>
                                    <td class="center">{{ $val->batch_name }}</td>
                                    <td class="center">BDT {{ number_format($val->admission_fee, 2) }}</td>
                                    <td class="center">{{ $val->group_link }}</td>
                                    <td class="center">{{ $val->created_at }}</td>
                                </tr>
                            @endforeach
                        @endisset
	                </tbody>
	            </table>
			</div>
		</div>
	</div>
</div>

<div id="courseEnrollModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Enroll New Course</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('save-student-course') }}" method="POST">
                @csrf
                    <div class="row">
                        <input type="hidden" name="student_id" value="{{ Session('studentId') }}" class="form-control" />
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Course <span style="color:#DC3545">*</span></label>
                                <select name="course_id" class="form-control" required>
                                    <option value="">--Select Course--</option>
                                    @foreach($all_courses as $value)
                                        <option value="{{ $value->id }}">{{ $value->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Batch <span style="color:#DC3545">*</span></label>
                                <select name="batch_id" class="form-control" required>
                                    <option value="">--Select Batch--</option>
                                    @foreach($all_batches as $value)
                                        <option value="{{ $value->id }}">{{ $value->batch_name }} ({{ $value->batch_timing }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-signup">Submit</button>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

@endsection