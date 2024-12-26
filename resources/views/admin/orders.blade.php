@include('admin.header')

    <div class="col-md-12 p-5">
        <h1>Orders</h1>
        <div class="table-responsive">
            <table id="ordersTable" class="table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Total Amount</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('order.details', $order->id) }}" class="btn btn-info btn-sm">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#ordersTable').DataTable({
                "processing": true,
                "serverSide": false, // Set to true if you're loading data from server-side
                "paging": true,
                "searching": true,
                "ordering": true,
                "lengthMenu": [10, 25, 50, 100], // Define page lengths
                "pageLength": 10
            });
        });
    </script>
@include('admin.footer')