<div class="table-responsive">
    <table id="dataTable" class="table table-responsive table-striped table-bordered">
        <tbody>
            @isset($customer)
                <tr>
                    <th>ID</th>
                    <th>{{ $customer->id }}</th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>{{ $customer->customer_name }}</th>
                </tr>
                <tr>
                    <th>Phone</th>
                    <th>{{ $customer->mobile_no }}</th>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>{{ $customer->email_address }}</th>
                </tr>
                <tr>
                    <th>Joined</th>
                    <th>{{ $customer->created_at }}</th>
                </tr>
                <tr>
                    <th>Address</th>
                    <th>{{ $customer->address }}</th>
                </tr>
            @endisset
        </tbody>
    </table>
</div>
