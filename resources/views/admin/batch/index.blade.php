@extends('admin.layout.default')
@section('title_area', 'Manage Batch')
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get('class')}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                <form action="{{ route('batch.store', ['batch_id' => $selected_info->id ?? null]) }}" method="POST">
                @csrf
                    <div class="col-sm-12">
                        <div class="panel-group panel-group-joined" id="accordion-test">
                            <div class="panel panel-border panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                            Batch
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="category">Batch Name</label><small class="req">*</small>
                                                <input required name="batch_name" placeholder="Batch Name" type="text" value="{{ $selected_info->batch_name ?? old('batch_name') }}" class="form-control">
                                                @error('batch_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="category">Batch Timing</label><small class="req">*</small>
                                                <input required name="batch_timing" placeholder="Batch Timing" value="{{ $selected_info->batch_timing ?? old('batch_timing') }}"  type="text"  class="form-control">
                                                @error('batch_timing')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="category">Total Seat</label><small class="req">*</small>
                                                <input required name="total_seat" value="{{ $selected_info->total_seat ?? old('total_seat') }}" placeholder="Total Seat" type="text"  class="form-control">
                                                @error('total_seat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="category">Seat Left</label><small class="req">*</small>
                                                <input required name="seat_left" value="{{ $selected_info->seat_left ?? old('seat_left') }}" placeholder="Seat Left" type="text"  class="form-control">
                                                @error('seat_left')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="category">Group Link</label><small class="req">*</small>
                                                <input required name="group_link" value="{{ $selected_info->group_link ?? old('group_link') }}" placeholder="Group Link" type="text"  class="form-control">
                                                @error('group_link')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group pull-left m-t-22">
                                                <input type="submit" class=" btn btn-primary pull-right" value="Save" name="submit" />
                                            </div>
                                        </div>
                                    </div> <!-- panel-body -->
                                </div>
                            </div> <!-- panel -->
                        </div>
                    </div> <!-- col -->
                </form>
            </div> <!-- End row -->
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                        Batch List
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-responsive table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Batch Name</th>
                                                    <th>Batch Timing</th>
                                                    <th>Total Seat</th>
                                                    <th>Seat Left</th>
                                                    <th>Group Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($get_all)
                                                    @foreach($get_all as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->batch_name }}</td>
                                                            <td>{{ $value->batch_timing }}</td>
                                                            <td>{{ $value->total_seat }}</td>
                                                            <td>{{ $value->seat_left }}</td>
                                                            <td>{{ $value->group_link }}</td>
                                                            <td>
                                                                <a href="{{ route('batch.edit',['batch_id' => $value->id]) }}" class=" btn btn-default btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>

                                                                <a onclick="return confirm('Are You Sure?')" href="{{ route('batch.destroy',['batch_id' => $value->id]) }}" class="text-danger btn btn-default  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- panel-body -->
                            </div>
                        </div> <!-- panel -->
                    </div>
                </div> <!-- col -->
            </div>
        </div> <!-- container -->
    </div>
@endsection
