@extends('admin.layout.default')
@section('title_area')
    Sales Report
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
                {!! Form::open(['onsubmit'=>'return(validate())', 'id' => 'upload-form', 'name'=>'user', 'method'=>'POST']) !!}
                    <div class="col-sm-12">
                        <div class="panel-group panel-group-joined" id="accordion-test">
                            <div class="panel panel-border panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                            Sales Report
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        @if(is_super_admin())
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="user_id">Marchent</label>
                                                    <select name="marchent_id" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="">--Please Select--</option>
                                                    @foreach($allMarchent as $marchent)
                                                        <option value="{{ $marchent->id }}">{{ $marchent->shop_name }} ({{ $marchent->name }})</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="user_id">Date Range</label>
                                                <select id="last_date" name="last_date" class="form-control selectpicker" data-live-search="true">
                                                <option value="">--Please Select--</option>
                                                    <option value="7">Last 7 Days</option>
                                                    <option value="15">Last 15 Days</option>
                                                    <option value="30">Last 30 Days</option>
                                                    <option value="Custom">Custom Dates Range</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="date-area">
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
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group pull-left">
                                                <div style="margin-top:24px;"></div>
                                                <input type="submit" class="btn btn-primary pull-right submit_btn" value="Show Report" name="submit" />
                                            </div>
                                        </div>
                                    </div> <!-- panel-body -->
                                </div>
                            </div> <!-- panel -->
                        </div>
                    </div> <!-- col -->
                {!! Form::close() !!}
            </div> <!-- End row -->
            
            <div class="row" id="printableArea">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info" id="view_report"> 
                            
                        </div> <!-- panel -->
                    </div>
                </div> <!-- col -->
            </div>
        
        </div> <!-- container -->
    </div>

    <script src="{{asset('admin/vendors/timepicker/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript">

        // Submit the form on file selection
        $('.submit_btn').on('click', function () {
            $('#upload-form').submit();
        });

        // Handle form submission and image upload via AJAX
        $('#upload-form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin.sales-report') }}',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        // Reload the list
                        $('#view_report').html(response.sales_report);
                    }
                }
            });
        });

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

        $(function(){
            $("#last_date").on('change',function(){
               let id= $(this).val();
               $("#date-area").hide()
                if(id == "Custom"){
                    $("#date-area").show()
                }
            })
        })

    </script>
@endsection
