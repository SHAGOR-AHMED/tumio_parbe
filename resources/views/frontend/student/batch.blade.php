@extends('frontend.layout.default')
@section('title_area', 'Our Batches')
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
				<table id="order_table" class="table table-striped table-bordered" style="width:100%">
	                <thead>
	                    <tr>
	                        <th>SN</th>
	                        <th>Batch Name</th>
	                        <th>Batch Time</th>
	                        <th>Total Seat</th>
	                        <th>Seat Left</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @foreach($get_all as $key => $val)
		                    <tr>
		                        <td>{{ ++$key }}</td>
		                        <td class="center">{{ $val->batch_name }}</td>
		                        <td class="center">{{ $val->batch_timing }}</td>
		                        <td class="center">{{ $val->total_seat }}</td>
		                        <td class="center">{{ $val->seat_left }}</td>
		                    </tr>
	                    @endforeach
	                </tbody>
	            </table>
			</div>
		</div>
	</div>
</div>

<!-- JS code -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script type="text/javascript">
	
</script>
@endsection