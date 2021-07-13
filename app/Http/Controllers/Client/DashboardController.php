<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Axiom\Rules\StrongPassword;
use Jenssegers\Agent\Agent;
use App\Helper\Helper;
use App\Helper\CourseHelper;
use Carbon\Carbon;
use Throwable;
use Axiom\Rules\TelephoneNumber;


use App\Models\Hashtag;
use App\Models\Cart;
use App\Models\Province;
use App\Models\City;
use App\Models\Order;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Redeem;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\Course;
use App\Mail\PasswordChangedMail;

class DashboardController extends Controller
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
    
    // Shows the client User Dashboard page.
    public function index(Request $request)
    {
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        $this->resetNavbarData();

        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

       
        // $cart_count = Cart::with('course')
        //     ->where('user_id', auth()->user()->id)
        //     ->count();
        // $transactions = Notification::where(
        //     [   
        //         ['user_id', '=', auth()->user()->id],
        //         ['isInformation', '=', 0],
                
        //     ]
        //     )->orderBy('created_at', 'desc')->get();
        
        $orders = Order::whereHas('invoice', function ($query){
            $query->where(
                [
                    ['status', '=', 'paid'],
                    ['user_id', '=', auth()->user()->id],
                ],
            )->orWhere(
                [
                    ['status', '=', 'completed'],
                    ['user_id', '=', auth()->user()->id],
                ],
            );
                })->orderBy('orders.created_at', 'desc')->get();

        $interests = Hashtag::all();
        // $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();
        // $notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();


        $usableStarsCount = Helper::getUsableStars(auth()->user());       
        $mytime = Carbon::now();
        $mytime->setTimezone('Asia/Phnom_Penh');
        $today = explode(' ', $mytime);
        //check live woki and change status to complete if date time has passed
        foreach(auth()->user()->courses->where('course_type_id','!=',1) as $course){
            if($today[0] >= $course->wokiCourseDetail->event_date && $course->wokiCourseDetail->end_time <= $today[1]){
                $course->pivot->status = 'completed';
                $course->pivot->save();

            }
        }

		// Get courses suggestions.
        $courseSuggestions = CourseHelper::getCourseSuggestion(4);

        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        $provinces = Province::all();

        if ($request->has('province')) {
            $province_id = $request['province'];
            $cities = City::where('province_id', $province_id)->get();
        } else{
            if(auth()->user()->userDetail->city_id != null)
                $cities = City::get();
            else
                $cities = null;
        }

        return view('client/user-dashboard',
            compact('provinces', 'cities', 'cart_count', 'transactions', 'orders', 'interests', 'informations', 'notifications', 'usableStarsCount', 'courseSuggestions', 'footer_reviews'));
    }

    public function update_shipping(Request $request,$id)
    {
        $input = $request->all();
        $validated = Validator::make($input,[
            'province_id'   => 'required',
            'city_id'       => 'required',
            'address'       => 'required',
        ]);

        if($validated->fails()) 
            return redirect('/dashboard#edit-profile')
                ->withErrors($validated)
                ->withInput($request->all());
        else 
            $validated = $validated->validate();
        
        
        $user = User::findOrFail($id);

        $user_detail = $user->userDetail;
        $user_detail->province_id   = $validated['province_id'];
        $user_detail->city_id       = $validated['city_id'];
        $user_detail->address       = $validated['address'];
        
        //check if the user update the shipping for the first time
        if(!$user->isShippingUpdated){
            $user->isShippingUpdated = TRUE;
        }

    
        //check if the user update the profile for the first time
        if(!$user->isProfileUpdated && $user->isShippingUpdated && $user->isGeneralInfoUpdated){
            $user->isProfileUpdated = TRUE;
            // here insert star reward
            //tambah 15 stars
            Helper::addStars(auth()->user(),15,'Completing Personal Data');
            $user_detail->save();
            return redirect('/dashboard#edit-profile')->with('success', 'Update Profile Berhasil! kamu mendapatkan 15 stars.');
        }
        $user_detail->save();



        return redirect('/dashboard#edit-profile')->with('success', 'Update Profile Berhasil!');

    }


    // Updates Users's data in the database.
    public function update_profile(Request $request, $id)
    {
        $input = $request->all();
        // Convert request input "phone" format.
        if ($request->has('telephone'))
            $input['telephone'] = preg_replace("/[^0-9 ]/", '', $input['telephone']);
            
        $validated = Validator::make($input,[
            'name'          => 'required',
            //'telephone'     => ['required', new TelephoneNumber],
            'telephone'     => 'required',
            'birthdate'     => 'date',
            'gender'        => 'required',
            'company'       => 'required',
            'occupancy'     => 'required',
        ]);

        if($validated->fails()) 
            return redirect('/dashboard#edit-profile')
                ->withErrors($validated)
                ->withInput($request->all());
        else 
            $validated = $validated->validate();
        

        $user = User::findOrFail($id);
        $user->name = $validated['name'];

        if ($request->has('avatar')) {
            if($user->avatar)
                unlink($user->avatar);
            $user->avatar = Helper::storeImage($request->file('avatar'), 'storage/images/users/');
        }


        $user_detail = $user->userDetail;
        $user_detail->update($request->except([
            'name','province_id','city_id','address'
        ]));

        //check if the user update the general info for the first time
        if(!$user->isGeneralInfoUpdated){
            $user->isGeneralInfoUpdated = TRUE;
        }

        //check if the user update the profile for the first time
        if(!$user->isProfileUpdated && $user->isShippingUpdated && $user->isGeneralInfoUpdated){
            $user->isProfileUpdated = TRUE;
            // here insert star reward
            //tambah 15 stars
            Helper::addStars(auth()->user(),15,'Completing Personal Data');
            $user->save();
            return redirect('/dashboard#edit-profile')->with('success', 'Update Profile Berhasil! kamu mendapatkan 15 stars.');
        }
        $user->save();



        return redirect('/dashboard#edit-profile')->with('success', 'Update Profile Berhasil!');
    }

    public function update_interest(Request $request)
    {
        $validated = $request->validate([
            'interests' => 'required|array',
        ]);

        //here store to user and user detail table

        $hashtag_ids= [];
        foreach($validated['interests'] as $hashtag_id => $flag)
        {
            if($flag == '1') 
                $hashtag_ids[] = $hashtag_id;
        }

        if(count($hashtag_ids) > 3)
            return redirect('/dashboard#my-interests')->with('message','testing');
        
        auth()->user()->hashtags()->sync($hashtag_ids);

        return redirect('/dashboard#my-interests')->with('update_interest_success', 'Update Profile Berhasil!');
    }

    // Changes the user's password in the database.
    public function changePassword(Request $request) {
        // Use StrongPassword validation on production.
        if (App::environment('production'))
            $validation_rules = [
                'old_password' => 'required',
                'password' => ['required', 'confirmed', new StrongPassword]
            ];
        else
            $validation_rules = [
                'old_password' => 'required',
                'password' => ['required', 'confirmed']
            ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return redirect(route('customer.dashboard') . '#change-password')
                ->withErrors($validator);
        }

        $validated = $request->only(['old_password', 'password']);
        $user = auth()->user();

        // Check if old password matches.
        if (!Hash::check($validated['old_password'], $user->password)) {
            return redirect(route('customer.dashboard') . '#change-password')
                ->withErrors([
                    'old_password' => 'Current password does not matched..'
                ]);
        }

        // Check if new password is the same with old password.
        if (Hash::check($validated['password'], $user->password)) {
            return redirect(route('customer.dashboard') . '#change-password')
                ->withErrors([
                    'password' => 'New pasword cannot be the same..'
                ]);
        }

        $user->password =  Hash::make($validated['password']);
        $user->save();

        if ($user->wasChanged()) {
            $messageTopic = 'success';
            $message = 'Your password has been changed. A notification email has been sent to your email.';
            try {
                Mail::to(auth()->user()->email)->send(new PasswordChangedMail());
            } catch (Throwable $e) {
                $user->password =  Hash::make($validated['old_password']);
                $user->save();
                $messageTopic = 'danger';
                $message = 'Oops, unable to send email. Your old password has been kept.';
                if (!App::environment('production'))
                    $message = $e->getMessage();
            }
        } else {
            $messageTopic = 'danger';
            $message = 'Oops, unable to update your password.';
        }

        return redirect(route('customer.dashboard') . '#change-password')->with($messageTopic, $message);
    }

    public function redeem_index(Request $request){
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        $this->resetNavbarData();

        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        // $cart_count = Cart::with('course')
        //     ->where('user_id', auth()->user()->id)
        //     ->count();
        // $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();
        // $notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        // $transactions = Notification::where(
        //     [   
        //         ['user_id', '=', auth()->user()->id],
        //         ['isInformation', '=', 0],
                
        //     ]
        //     )->orderBy('created_at', 'desc')->get();

        $redeem_rules = Redeem::orderBy('created_at','desc')->get();
        $my_vouchers = Promotion::where('user_id',auth()->user()->id)->orderBy('updated_at','desc')->get();

        $next_year = explode(' ', Carbon::now()->addYear(1));
        $next_year_date=$next_year[0];
        $current_year = explode(' ', Carbon::now());
        $current_year_date=$current_year[0];

        $usableStarsCount = Helper::getUsableStars(auth()->user());

        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/vouchers',
            compact('cart_count', 'informations', 'transactions', 'notifications', 'redeem_rules', 'next_year_date', 'current_year_date', 'my_vouchers', 'usableStarsCount','footer_reviews'));
    }

    public function redeemPromo(Request $request)
    {
        $redeem = Redeem::findOrFail($request->redeem_id);
        $usableStarsCount = Helper::getUsableStars(auth()->user());
        //check whether starsnya cukup atau enggak
        if($usableStarsCount > $redeem->stars)
        {
            $new_promo_id = Promotion::orderBy('created_at','desc')->first()->id +1;
            $new_name = substr(auth()->user()->name, 0,3);
        
            $promo_name = 'DISC'.$new_name.$new_promo_id;
            
            //get current date
            $current_year = explode(' ', Carbon::now());
            $current_year_date = $current_year[0];

            //get next year date
            $next_year = explode(' ', Carbon::now()->addYear(1));
            $next_year_date = $next_year[0];

            //1. buat promo khusus untuk user
            $promotion = new Promotion();
            $promotion->user_id         = auth()->user()->id;
            $promotion->code            = $promo_name;
            $promotion->type            = $redeem->type;
            $promotion->promo_for       = $redeem->promo_for;
            $promotion->discount        = $redeem->discount;

            if($redeem->promo_for == 'charity')
                $promotion->isActive        = 0;
            else
                $promotion->isActive        = 1;

            $promotion->start_date      = $current_year_date;
            $promotion->finish_date     = $next_year_date;
            $promotion->save();

            //2. buat notifikasi
            if($redeem->promo_for == 'charity')
                $description = 'Hi, '.auth()->user()->name.' terimakasih telah mendonasi sebesar Rp'.$redeem->discount;
            else
                $description = 'Hi, '.auth()->user()->name.'. redeem voucher '.$promo_name.' telah berhasil';

            $notification = Notification::create([
                'user_id'           => auth()->user()->id,
                'isInformation'     => 1,
                'title'             => 'Redeem Voucher Berhasil',
                'description'       => $description,
                'link'              => '/dashboard/redeem-vouchers'
            ]);

            //3. kurangin stars
            //auth()->user()->stars -= $redeem->stars;
            //auth()->user()->save();
            $userStars = auth()->user()->stars()->whereDate('valid_until', '>=', Carbon::today())->orderBy('created_at','asc')->get();
            $redeem_cost = $redeem->stars;
            $flag = TRUE;
            foreach($userStars as $star)
            {
                if($flag)
                {
                    if($star->stars >= $redeem_cost)
                    {
                        $star->stars -= $redeem_cost;
                        $star->save();
                        $flag = FALSE;
                    }
                    else{
                        $redeem_cost -= $star->stars;
                        $star->stars = 0;
                        $star->save();
                    }
                }
            }

            Helper::checkAndUpdateUserClub(auth()->user());

            return redirect()->back()->with('redeem_success','Redeem stars berhasil');
        }
        //kalau stars user gak mencukupi
        else{
            return redirect()->back()->with('redeem_failed','Stars kamu tidak mencukupi');
        }
    }
}
