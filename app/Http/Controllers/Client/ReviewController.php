<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;
use App\Helper\Helper;
use App\Helper\CourseHelper;
use Carbon\Carbon;

use App\Models\Review;

/*
|--------------------------------------------------------------------------
| Client ReviewController Class.
|
| Description:
| This controller is responsible in handling functionalities & features
| related to reviews in the client side (non-admin) of the web app.
|--------------------------------------------------------------------------
*/
class ReviewController extends Controller
{
    // Stores new review in the database.
    public function store(Request $request) {
        $validated = Validator::make($request->all(),[
            'rating' => 'required',
            'course_id' => 'required|integer'
        ]);

        $url_prefix = ($request->course_type == 1) ? '/online-course/' : '/woki/';

        if($validated->fails() && $request->action == "completed_course") 
            return redirect()->back()->withErrors($validated);

        if($validated->fails() && $request->action == "course_detail_review")
            return redirect($url_prefix.$request->course_name.'#review-section')
                ->with('review_message', 'Tidak bisa review kosong.')
                ->withErrors($validated);
        
        //check whether user has completed its course or not
        $course = auth()->user()->courses()->where('course_id', $request->course_id)->first();
        
        //kalau user belum punya course nya
        if(!$course)
            return redirect($url_prefix.$request->course_name.'#review-section')
                ->with('review_message', 'Kamu belum punya course ini!');
        
        //kalau user belum selesaikan course
        if($request->action == "course_detail_review") {
            if($course->pivot->status == 'on-going' && $course->course_type_id == 1)
                return redirect($url_prefix.$request->course_name.'#review-section')
                    ->with('review_message', 'Selesaikan course terlebih dahulu!');
        }

        $reviews = Review::where([   
            ['user_id', '=', auth()->user()->id],
            ['course_id', '=', $request->course_id],    
        ])->get();

        if (count($reviews) != 0) {
            if ($request->action == "completed_course")
                return redirect()->back()->with('review_message_double', 'Anda sudah mereview course ini');
            else
                return redirect($url_prefix.$request->course_name.'#review-section')
                    ->with('review_message', 'Anda sudah mereview course ini');
        }

        $review = Review::create([
            'user_id'       => auth()->user()->id,
            'course_id'     => $request->course_id,
            'review'        => $request->rating,
            'description'   => $request->description
        ]);

        // New review successfully created.
        if ($review) {
            Helper::addStars(auth()->user(), 30, 'Review Course');
            CourseHelper::calculateAverageRating($course->id);

            if($request->action == "completed_course")
                return redirect()->back()
                    ->with('review_message','Review berhasil dimasukkan, dan kamu mendapatkan 30 Stars!');
            else
                return redirect($url_prefix.$request->course_name.'#review-section')
                    ->with('review_message', 'Review berhasil dimasukkan, dan kamu mendapatkan 30 Stars!');
        }

        // Failed in creating a new review.
        if ($request->action == "completed_course")
            return redirect()->back()
                ->with('review_message','Oops.. an error has occured');
        else
            return redirect($url_prefix.$request->course_name.'#review-section')
                ->with('review_message', 'Oops.. an error has occured');
    }

    public function destroy($id){
        $review = Review::findOrFail($id);
        $review->delete();

        $user = auth()->user();

        $userStars = $user->stars()->whereDate('valid_until', '>=', Carbon::today())->orderBy('created_at','asc')->get();

        $redeem_cost = 30; $flag = TRUE;
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

        $user->userDetail->total_stars -= 30;
        $user->userDetail->save();

        Helper::checkAndUpdateUserClub(auth()->user());

        return redirect('/online-course/'.$review->course->id.'#review-section')
                    ->with('review_message', 'Review berhasil dihapus!');
    }
}
