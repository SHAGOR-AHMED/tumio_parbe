@extends('admin.layout.default')
@section('title_area')
Marchant List
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
            @isset($marchent_list)
            <div class="row" id="printableArea">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">

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
                                                    <th>Logo</th>
                                                    <th>Commission</th>
                                                    <th>Joining Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($marchent_list as $marchent_info)
                                                <tr>
                                                   <td>{{ $loop->iteration }}</td>
                                                   <td>{{ $marchent_info->shop_name }}<br>{{ $marchent_info->name }}({{ $marchent_info->phone }})
                                                   <br><strong> Email : </strong>{{ $marchent_info->email }}
                                                   <br><strong> Account Type : </strong> {{ $marchent_info->tin ? 'Professional':'Personal' }}
                                                   @if($marchent_info->tin!=null)<i class='fa fa-eye'><a href='{{ asset($marchent_info->tin) }}' target='_blank'>Tin</a></i>@endif
                                                   @if($marchent_info->nid!=null)<i class='fa fa-eye'><a href='{{ asset($marchent_info->nid) }}' target='_blank'>N.ID</a></i>@endif
                                                   <br><strong> Address : </strong>{{ $marchent_info->address }}
                                                   </td>
                                                   <td><img src="{{ asset($marchent_info->shop_logo) }}" alt="shop-logo" width="100"></td>
                                                   <td><a style='border-radius:5px;' class='btn btn-success btn-xs btnUpdate'> {{ $marchent_info->commision }} <i class="fa fa-percent"></i></a></td>
                                                    <td>{{ $marchent_info->created_at }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if($marchent_list instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        {{$marchent_list->links()}}
                                        @endif
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
