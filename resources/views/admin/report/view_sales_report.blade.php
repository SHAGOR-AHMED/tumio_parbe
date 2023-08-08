@isset($reports[0]->Order_date)
<div>
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                Report From ({{ $from_date }} - {{ $to_date}})
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
                            <th>Order Date</th>
                            <th>Total Order</th>
                            <th>Sale Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($reports as $key=>$value)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $value->Order_date }}</td>
                            <td>{{ $value->total_order }}</td>
                            <td>{{ number_format($value->saleamount,2) }}</td>
                        </tr>
                        @php $total+= $value->saleamount; @endphp
                        @endforeach
                        <tr class="table table-info">
                            <td colspan="3" class="text-right">Total Amount</td>
                            <td>{{ number_format($total,2) }}  TK</td>
                        </tr>
                        <tr class="table table-info">
                            <td colspan="3" class="text-right">Commission </td>
                            <td>{{ number_format($total*$user->commision/100,2).' ('.$user->commision.' %)' }}  TK</td>
                        </tr>
                        <tr class="table table-info">
                            <td colspan="3" class="text-right">Receivable </td>
                            <td>{{ number_format($total-$total*$user->commision/100,2) }}  TK</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> <!-- panel-body -->
    </div>
</div> <!-- panel -->
@endisset