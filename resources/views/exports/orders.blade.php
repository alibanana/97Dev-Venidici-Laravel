<table>
    <thead>
        <tr>
            <th>#</th>
            <th>user</th>
            <th>invoice_no</th>
            <th>invoice_status</th>
            <th>invoice_grand_total</th>
            <th>order_id</th>
            <th>course_title</th>
            <th>course_type</th>
            <th>course_category</th>
            <th>order_qty</th>
            <th>order_withArtOrNo</th>
            <th>order_price</th>
            <th>order_updated_at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->invoice->name }}</td>
                <td>{{ $order->invoice->invoice_no }}</td>
                <td>{{ $order->invoice->status }}</td>
                <td>{{ $order->invoice->grand_total }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->course->title }}</td>
                <td>{{ $order->course->courseType->type }}</td>
                <td>{{ $order->course->courseCategory->category }}</td>
                <td>{{ $order->qty }}</td>
                @if ($order->withArtOrNo)
                    <td>yes</td>
                @else
                    <td>no</td>
                @endif
                <td>{{ $order->price }}</td>
                <td>{{ $order->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>