<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

use App\Helper\Helper;
use App\Helper\UserHelper;

use App\Models\Review;
use App\Models\User;
use App\Models\CandidateDetail;

class JobPortalController extends Controller
{
    private const INDEX_ROUTE = 'job-portal.index';
    private const CONTACTED_CANDIDATES_PAGE_SIZE = 4;

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

        $candidateDetails = CandidateDetail::with('user', 'interests')->get()
            ->filter(function ($candidateDetail, $key) {
                return !UserHelper::isCandidateDetailDataAndRelationshipEmpty($candidateDetail);
            });

        $candidateDetailIdAndCombinedInterestMap =
            $this->generateCandidateDetailIdAndCombinedInterestMap($candidateDetails);

        $contactedCandidates = Auth::user()->candidates()
            ->with('candidateDetail')
            ->paginate(self::CONTACTED_CANDIDATES_PAGE_SIZE);
        
        return view('client/job-portal/company/index', compact('cart_count', 'notifications', 'transactions',
            'informations', 'footer_reviews', 'agent', 'candidateDetails', 'candidateDetailIdAndCombinedInterestMap',
            'contactedCandidates'));
    }

    private function generateCandidateDetailIdAndCombinedInterestMap($candidateDetails) {
        return $candidateDetails->mapWithKeys(function ($candidateDetail, $key) {
            $combinedInterestsString = '';
            foreach ($candidateDetail->interests as $interest) {
                $combinedInterestsString = $combinedInterestsString . $interest->title . ', ';
            }
            return [$candidateDetail->id => substr($combinedInterestsString, 0, -2)];
        });
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

    // Contact user (candidate) & Adding them to Hiring Partner's Contacted Candidate List.
    public function contactCandidate(Request $request) {
        $validated = $request->validate(['user_id' => 'required|integer']);

        $candidate = User::where('id', $validated['user_id'])
            ->has('candidateDetail')
            ->firstOrFail();

        $candidate->hiringPartners()->attach(Auth::user()->id);

        $message = 'Candidate (' . $candidate->name . ') has been contacted through email & is now available on you list.';
        return redirect()->route(self::INDEX_ROUTE)->with('message', $message);
    }

    // Accepts a Contacted Candidate (user). Assumes that candidate has already be contacted.
    public function acceptContactedCandidate(Request $request) {
        $validated = $request->validate(['user_id' => 'required|integer']);

        $candidate = User::where('id', $validated['user_id'])
            ->has('candidateDetail')
            ->firstOrFail();

        if (UserHelper::isCandidateHired($candidate->id)) {
            $message = 'Candidate (' . $candidate->name . ') has already been hired';
        } else if (!UserHelper::isHiringPartnerCandidateExists(Auth::user()->id, $candidate->id)) {
            $message = 'Candidate (' . $candidate->name . ') has not been added to your list.';
        } else {
            UserHelper::hireCandidate($candidate, Auth::user()->id);
            $message = 'Candidate (' . $candidate->name . ') has successfully been accepted on your company.';
        }

        return redirect()->route(self::INDEX_ROUTE)->with('my_list_message', $message);
    }
}
