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

        return view('admin/invoice/index', compact('invoices'));
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
