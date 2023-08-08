@extends('admin.layout.default')
@section('title_area')
    Merchant Product Stock
@endsection
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                        Stock List
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
                                                    <th>Merchant Name</th>
                                                    <th>Registered on</th>
                                                    <th>Current Product Stock</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($products_stock)
                                                    @foreach($products_stock as $key=>$value)
                                                        <tr>
                                                            <td>{{++$key}}</td>
                                                            <td>{{$value->name}}</td>
                                                            <td>{{ date('d-M-Y',strtotime($value->created_at)) }}</td>
                                                            <td>{{ $value->current_Stock }}</td>
                                                            
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
