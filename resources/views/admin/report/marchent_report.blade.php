@extends('admin.layout.default')
@section('title_area')
    Product Report
@endsection
@section('main_section')

    <style type="text/css">
        @media 
        print {
            .btn{display: none}
            #printableArea { 
                width:100%; 
            }
        }
    </style>
    
    <div class="content">
        <div class="container">
            <div class="row">
                {!! Form::open(['route' => 'admin.report', 'onsubmit'=>'return(validate())' , 'name'=>'user', 'method'=>'POST']) !!}
                    <div class="col-sm-12">
                        <div class="panel-group panel-group-joined" id="accordion-test">
                            <div class="panel panel-border panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                            Marchent Report
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="qty">From Date </label><small class="req">*</small>
                                                <input name="from_date" id="from_date" autocomplete="off" type="text" value="{{ date('Y-m-d') }}" placeholder="Start Date" class="form-control date" >
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="qty">To Date </label><small class="req">*</small>
                                                <input name="to_date" id="to_date" type="text" autocomplete="off" value="{{ date('Y-m-d') }}" placeholder="End Date" class="form-control date">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="user_id">Marchent</label>
                                                <select id="user_id" name="user_id" class="form-control selectpicker" data-live-search="true">
                                                <option value="">--Please Select--</option>
                                                    @if(count($get_all_user)>0)
                                                        @foreach($get_all_user as $value)
                                                            @if($value->role_id != 1)
                                                                <option value="{{ $value->id }}">{{ $value->name }} ({{ $value->shop_name }})</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-12">
                                            <div class="form-group pull-left">
                                                <input type="submit" class=" btn btn-primary pull-right" value="Submit" name="submit" />
                                            </div>
                                        </div>
                                    </div> <!-- panel-body -->
                                </div>
                            </div> <!-- panel -->
                        </div>
                    </div> <!-- col -->
                {!! Form::close() !!}
            </div> <!-- End row -->
            @isset($report)
            <div class="row" id="printableArea">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                        Report From ({{ date('d-M-Y',strtotime($from_date)) }} - {{ date('d-M-Y',strtotime($to_date))}})
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" >
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="printDiv('printableArea')" ><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                        <table id="datatable" class="table table-responsive table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Marchent Info</th>
                                                    <th>Total Sell</th>
                                                    <th>Commission ({{ $marchent_info->commision}} <i class="fa fa-percent"></i> )</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   <td>1</td>
                                                   <td>{{ $marchent_info->shop_name }}<br>{{ $marchent_info->name }}({{ $marchent_info->phone }})
                                                   <br><strong> Email : </strong>{{ $marchent_info->email }}
                                                   <br><strong> Account Type : </strong> {{ $marchent_info->tin ? 'Professional':'Personal' }} 
                                                   @if($marchent_info->tin!=null)<i class='fa fa-eye'><a href='{{ asset($marchent_info->tin) }}' target='_blank'>Tin</a></i>@endif
                                                   @if($marchent_info->nid!=null)<i class='fa fa-eye'><a href='{{ asset($marchent_info->nid) }}' target='_blank'>N.ID</a></i>@endif
                                                   <br><strong> Address : </strong>{{ $marchent_info->address }}
                                                   </td>
                                                   <td>BDT {{ number_format($report->total_sell,2) }}</td>
                                                   <td>{{ number_format(($report->total_sell * $marchent_info->commision/100),2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- panel-body -->
                            </div>
                        </div> <!-- panel -->
                    </div>
                </div> <!-- col -->
            </div>
            @endisset
        </div> <!-- container -->
    </div>

    <script src="{{asset('admin/vendors/timepicker/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript">

        $('.date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true
        });

        function validate(){
            if(document.user.user_id.value==0){
                swal("Alert","Required field can't be Empty","info",{
                    button:"ok"
                });
                return false;
            }
            return true;
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        
    </script>
@endsection