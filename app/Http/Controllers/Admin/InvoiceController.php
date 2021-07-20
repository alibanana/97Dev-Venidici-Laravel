<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| Admin InvoiceController Class.
|
| Description:
| This controller is responsible in handling the admin's invoices pages.
|--------------------------------------------------------------------------
*/
class InvoiceController extends Controller
{
    // Shows the admin Invoices page.
    public function index(Request $request) {
        $invoices = new Invoice;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $invoices = $invoices->orderBy('created_at', 'desc');
            } else {
                $invoices = $invoices->orderBy('created_at');
            }
        } else {
            $invoices = $invoices->orderBy('created_at', 'desc');
        }

        if ($request->has('filterStatus')) {
            $available_filters = ['Pending', 'Completed', 'Failed', 'Paid', 'Cancelled'];
            if (!in_array($request->filterStatus, $available_filters)) {
                $url = route('admin.invoices.index', request()->except('filterStatus'));
                return redirect($url);
            }

            $invoices = $invoices->where('status', strtolower($request->filterStatus));
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.invoices.index', request()->except('search'));
                return redirect($url);
            } else {
                $invoices = $invoices->where('invoice_no', 'like', "%".$request->search."%");
            }
        }

        $invoices = $invoices->paginate(50);

        // Get Cards data.
        $invoicesCountByStatus = []; $invoicesTotalByStatus = [];
        foreach (Invoice::all() as $invoice) {
            if (array_key_exists($invoice->status, $invoicesCountByStatus)) {
                $invoicesCountByStatus[$invoice->status] += 1;
                $invoicesTotalByStatus[$invoice->status] += $invoice->grand_total;
            } else {
                $invoicesCountByStatus[$invoice->status] = 1;
                $invoicesTotalByStatus[$invoice->status] = $invoice->grand_total;
            }
        }

        // Format invoicesTotalByStatus data
        foreach ($invoicesTotalByStatus as $key => $value) {
            $invoicesTotalByStatus[$key] = number_format($value, 2, ',', '.'); 
        }

        return view('admin/invoice/index', compact('invoices', 'invoicesCountByStatus', 'invoicesTotalByStatus'));
    }

    // Shows the admin Invoice Details page.
    public function show($id) {
        $invoice = Invoice::findOrFail($id);
        
        $noWoki = TRUE;
        foreach($invoice->orders as $cart) {
            if($cart->course->course_type_id == 2)
                $noWoki = FALSE;
        }

        $orders = Order::with('course')
            ->where('invoice_id', $invoice->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin/invoice/detail', compact('invoice','noWoki','orders'));
    }
}
