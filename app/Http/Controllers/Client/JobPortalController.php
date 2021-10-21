<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

use App\Helper\Helper;
use App\Models\Review;

class JobPortalController extends Controller
{
    private $notifications; // Stores combined notifications data.
    private $informations; // Stores notification (isInformation == true) data.
    private $transactions; // Stores notification (isInformation == false) data for a particular user.
    private $cart_count; // Stores cart data for a particular user.

    private function resetNavbarData() {
        $navbarData = Helper::getNavbarData();
        $this->notifications = $navbarData['notifications'];
        $this->informations = $navbarData['informations'];
        $this->transactions = $navbarData['transactions'];
        $this->cart_count = $navbarData['cart_count'];
    }

    // Shows the Client Job Portal Page. 
    public function index() {
        $agent = new Agent();

        $footer_reviews = Review::orderBy('created_at', 'desc')->get()->take(2);

        
        
        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;
        
        return view('client/job-portal/company/index', compact('cart_count', 'notifications', 'transactions',
            'informations', 'footer_reviews', 'agent'));
    }

    // Shows the Client Job Portal Profile page.
    public function profileIndex() {
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        if(Auth::check()) {
            $this->resetNavbarData();
            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            return view('client/job-portal/company/profile', compact('cart_count', 'notifications', 'transactions',
                'informations', 'footer_reviews', 'agent'));
        }
        
        return view('client/job-portal/company/profile', compact('footer_reviews', 'agent'));
    }
}
