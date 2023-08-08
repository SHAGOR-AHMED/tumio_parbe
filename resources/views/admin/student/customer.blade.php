@extends('admin.layout.default')
@section('title_area')
    Customer
@endsection
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
         {{--  Customer Details Modal  --}}
        <div class="detailStockModal modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-header">
                            <h4 class="modal-title">Customer Details</h4>
                        </div>
                        <div class="modal-body data-body">
                             {{--  Data Show here  --}}
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default cancel" data-dismiss="modal" value="Cancel">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                        Customer List
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
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Joined</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($customer_list)
                                                    @foreach($customer_list as $key=>$value)
                                                        <tr>
                                                            <td>{{++$key}}</td>
                                                            <td>{{$value->customer_name}}</td>
                                                            <td>{{$value->mobile_no}}</td>
                                                            <td>{{$value->email_address}}</td>
                                                            <td>{{$value->created_at}}</td>
                                                            <td>
                                                                <a title="View Details" href=".detailStockModal" data-id="{{ $value->id }}" class="btn btn-primary btn-xs btnShow" data-toggle="modal" data-original-title="View">View</a>
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
    <script>
        $(function(){
            $(document).on('click', '.btnShow',function(){
                let id=$(this).data("id");
                $.ajax({
                    type: 'GET',
                    url: "{{ route('admin.customer.show') }}",
                    data:{id: id},
                    success: function(data) {
                      $('.data-body').html(data.view);
                    },
                });
            });
        })
    </script>
@endsection
