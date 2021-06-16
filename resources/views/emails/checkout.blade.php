@component('mail::message')
#Thank you for your purchase

<strong>Invoice No:</strong> {{ $invoice['invoice_no']}}
<strong>Name:</strong> {{ $invoice['user_id']}}
<strong>Status:</strong> {{ $invoice['status']}}


@endcomponent