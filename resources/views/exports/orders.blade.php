<table>
    <thead>
        <tr>
            <td>DENGAN ART KIT</td>
        </tr>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Order ID</th>
            <th>Course Title</th>
            <th>Type</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>With Art</th>
            <th>Province</th>
            <th>City</th>
            <th>Address</th>
            <th>Course Price</th>
            <th>Invoice No</th>
            <th>Invoice Status</th>
            <th>Grand Total</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            @if ($order->withArtOrNo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->invoice->name }}</td>
                    <td>{{ $order->invoice->user->email }}</td>
                    <td>{{ $order->invoice->phone }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->course->title }}</td>
                    <td>{{ $order->course->courseType->type }}</td>
                    <td>{{ $order->course->courseCategory->category }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>yes</td>
                    <td>{{ $order->invoice->provinces }}</td>
                    <td>{{ $order->invoice->city }}</td>
                    <td>{{ $order->invoice->address }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->invoice->invoice_no }}</td>
                    <td>{{ $order->invoice->status }}</td>
                    <td>{{ $order->invoice->grand_total }}</td>
                    <td>{{ $order->updated_at }}</td>
                </tr>
            @endif
        @endforeach
        <tr></tr>
        <tr>
            <td>TANPA ART KIT</td>
        </tr>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Order ID</th>
            <th>Course Title</th>
            <th>Type</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>With Art</th>
            <th>Province</th>
            <th>City</th>
            <th>Address</th>
            <th>Course Price</th>
            <th>Invoice No</th>
            <th>Invoice Status</th>
            <th>Grand Total</th>
            <th>Updated At</th>
        </tr>
        @foreach($orders as $order)
            @if (!$order->withArtOrNo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->invoice->name }}</td>
                    <td>{{ $order->invoice->user->email }}</td>
                    <td>{{ $order->invoice->phone }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->course->title }}</td>
                    <td>{{ $order->course->courseType->type }}</td>
                    <td>{{ $order->course->courseCategory->category }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->invoice->invoice_no }}</td>
                    <td>{{ $order->invoice->status }}</td>
                    <td>{{ $order->invoice->grand_total }}</td>
                    <td>{{ $order->updated_at }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>