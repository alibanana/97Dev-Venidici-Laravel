<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Helper\XfersHelper;
use App\Helper\Helper;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use App\Models\Promotion;
use App\Exports\OrdersExport;
use App\Models\Course;

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
                $invoices = $invoices->orderBy('updated_at', 'desc');
            } else {
                $invoices = $invoices->orderBy('updated_at');
            }
        } else {
            $invoices = $invoices->orderBy('updated_at', 'desc');
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
                $invoices = $invoices->where('invoice_no', 'like', "%".$request->search."%")
                    ->orWhere('name', 'like', "%".$request->search."%");
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

        $courses = Course::all();

        return view('admin/invoice/index', compact('invoices', 'invoicesCountByStatus', 'invoicesTotalByStatus','courses'));
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

        // Get payment_object.
        $result = XfersHelper::getPaymentDetail($invoice->xfers_payment_id);
        if ($result['status'] == 'Failed')
            return redirect()->back()->with('message', $result['errors']['message']);

        $payment_object = $result['data'];
        // $payment_status = $payment_object['data']['attributes']['status'];

        return view('admin/invoice/detail', compact('invoice', 'noWoki', 'orders', 'payment_object'));
    }

    // Sync the status of each invoices data with Xfers's response.
    public function refresh() {
        $invoices = Invoice::where('status', 'pending')->orWhere('status', 'paid')->get();

        foreach ($invoices as $invoice) {
            $result = XfersHelper::getPaymentDetail($invoice->xfers_payment_id);
            if ($result['status'] == 'Failed')
                return redirect()->back()->with('message', $result['errors']['message']);

            $payment_object = $result['data'];
            $payment_status = $payment_object['data']['attributes']['status'];

            $user = User::findOrFail($invoice->user_id);
            $isUserFirstTransactionFlag = $this->isUserFirstTransaction($user);

            $oldStatus = $invoice->status;
            $invoice->status = $payment_status;
            $invoice->save();

            // If invoice's status was updated from pending to paid, this means that the user have just paid.
            // Therefore, courses & assessments should be mapped to that particular user.
            if ($oldStatus == 'pending' && ($invoice->status == 'paid' || $invoice->status == 'completed')) {
                foreach ($invoice->orders as $order) {
                    $course = $order->course;
                    if (!$user->courses->contains($course->id)) {
                        $user->courses()->syncWithoutDetaching([$course->id]);
                        if ($course->assessment()->exists()) {
                            $user->assessments()->attach($course->assessment->id);
                        }
                    }
                }

                // Add stars to user based on how much the user paid.
                $star_mulitiplication = (int) ($invoice->grand_total / 30000);
                $star_added = $star_mulitiplication * 12;
                if($star_added != 0)
                    Helper::addStars($user, $star_added, 'Pembelian Venidici On-Demand');

                // Check if user registered with a referral code && the user has registered on the current month &&
                // that its the user's first transaction.
                $referred_by_code = $user->userDetail->referred_by_code;
                if ($referred_by_code && $this->isUserCreatedAtDateValid() && $isUserFirstTransactionFlag) {
                    // Get referral code counter for a particular referral_code for this month.
                    $referralCodeCounter = $this->getReferralCodeCounterByReferralCode($referred_by_code);
                    if ($referralCodeCounter->counter < 5) {
                        $referralCodeCounter->counter += 1;
                        $referralCodeCounter->save();
                        // Add 60 points to the owner of the referred_by_code & to the current user.
                        Helper::addStars(User::find($referralCodeCounter->user_id), 60, 'penggunaan Referral Code kamu');
                        Helper::addStars($user, 60 , 'penggunaan Referral Code '. $referred_by_code);
                    }
                }

                $sentence = "";
                Mail::to($user->email)->send(new InvoiceMail($invoice,$sentence));
                $admins = User::where('user_role_id','!=',1)->get();
                foreach($admins as $admin){
                    $sentence = $user->name . ' telah membayar dengan ';
                    //Fernandha Dzaky telah membayar Skill Snack dengan
                    Mail::to($admin->email)->send(new InvoiceMail($invoice,$sentence));
                }
            }

            if ($oldStatus != $payment_status) {
                // start of courses string
                $courses_string = ""; $x = 1; $length = count($invoice->orders);
                foreach ($invoice->orders as $order) {
                    if($x == $length && $length != 1)
                        $courses_string = $courses_string." dan ";
                    elseif($x != 1)
                        $courses_string = $courses_string.", ";
        
                    $courses_string = $courses_string.$order->course->title;
                    $x++;
                }
                // end of courses string
    
                if ($payment_status == 'paid' || $payment_status == 'completed') {
                    foreach($invoice->notifications as $notif) {
                        if($notif->user_id == $user->id && $notif->invoice_id == $invoice->id) {
                            $notif->title = 'Pembayaran Telah Berhasil!';
                            $notif->description = 'Hi, '.$user->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah berhasil.';
                            $notif->save();
                        }
                    }
                } elseif ($payment_status == 'cancelled') {
                    // If promotions_code used is a personal one, change is_active back.
                    $promotion = $invoice->promo_code ? Promotion::where('code', $invoice->promo_code)->first() : null;
                    if ($promotion) {
                        $promotion->isActive = $promotion->user_id ? true : $promotion->isActive;
                        $promotion->save();
                    }

                    foreach ($invoice->notifications as $notif) {
                        if($notif->user_id == $user->id && $notif->invoice_id == $invoice->id)
                            $newNotif->title = 'Pembayaran Telah Dibatalkan!';
                            $newNotif->description = 'Hi, '.$user->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah dibatalkan.';
                            $newNotif->save();
                    }
                }  elseif ($payment_status == 'expired') {
                    foreach($invoice->notifications as $notif) {
                        if($notif->user_id == $user->id && $notif->invoice_id == $invoice->id) {
                            $notif->title = 'Pembarayan Kadaluarsa!';
                            $notif->description = 'Hi, '.$user->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah dibatalkan.';
                            $notif->save();
                        }
                    }
                }
            }

        }

        return redirect()->route('admin.invoices.index');
    }

    // Function to delete invoices (and its corresponding orders).
    //  - Invoice Status == pending, xfers_payment_id == null
    public function destroy($id) {
        $invoice = Invoice::findOrFail($id);
        $isXfersIdNull = $invoice->xfers_payment_id == null; $isStatusPending = $invoice->status == 'pending';
        if ($isXfersIdNull && $isStatusPending) {
            $invoice->orders()->delete();
            $invoice->delete();
            return redirect()->route('admin.invoices.index')
                ->with('message', 'Invoice (' . $invoice->id .') has been deleted from the database!');
        }
        $message = 'Invoice (' . $invoice->id . ') cannot be deleted!';
        $errorMessages = [];
        if (!$isXfersIdNull)
            $errorMessages[] = "XfersId must be null";
        if (!$isStatusPending)
            $errorMessages[] = "Status must be pending";
        return redirect()->route('admin.invoices.index')
            ->with('message', $this->constructErrorMessage($message, $errorMessages));
    }

    // Method to Export invoices data to excel and download them.
    public function export(Request $request) {
        $orders = $this->generateOrderQueryForOrderExport($request);
        if ($orders->count() == 0)
            return redirect()->back()->with('export-failed', 'Theres nothing to export!');
        return Excel::download(new OrdersExport($orders), 'invoices.xlsx');
    }

    private function generateOrderQueryForOrderExport(Request $request) {
        $orders = new Order;
        if ($request->has('course_id'))
            $orders = $orders->where('course_id', $request->course_id);
        if ($request->has('start_date') && $request->start_date)
            $orders = $orders->where('updated_at', '>=', $request->start_date);
        if ($request->has('end_date') && $request->end_date)
            $orders = $orders->where('updated_at', '<=', $request->end_date);
        return $orders->get();
    }

    // Method to check if current transaction is the user's first transaction.
    private function isUserFirstTransaction($user) {
        $paidOrCompletedInvoices = $user->invoices()
            ->where('status', 'paid')->orWhere('status', 'completed')->get();
        return $paidOrCompletedInvoices->isEmpty();
    }

    // Method to check if user has registered on the current month.
    private function isUserCreatedAtDateValid($user) {
        $createdAt = Carbon::parse($user->created_at);
        $createdAtPlus30Days = Carbon::parse($user->created_at)->addDays(30);
        return Carbon::now()->between($createdAt, $createdAtPlus30Days);
    }

    // Method to construct error messages.
    private function constructErrorMessage($baseMessage, $errorMessages) {
        $message = $baseMessage; $counter = 0;
        foreach ($errorMessages as $err) {
            if ($counter == 0)
                $message = $message . " [";
            if (($counter+1) == count($errorMessages)) {
                $message = $message . $err . "]";
            } else {
                $message = $message . $err . ", ";
            }
            $counter++;
        }
        return $message;
    }
}
