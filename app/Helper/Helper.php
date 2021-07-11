<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as ImageManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Exception;

use App\Mail\LevelUp;
use App\Models\Star;
use App\Models\Notification;
use App\Models\Cart;

class Helper
{
    // Function to show under-construction page if the mobile page is not ready.
    public static function mobileViewNotReady() {
        $agent = new Agent();
        return $agent->isPhone() ?
            view('client/mobile/under-construction') : null;
    }

    // Function to get neccessary navbar data.
    public static function getNavbarData() {
        $notifications = Notification::where('user_id', null)
            ->orWhere('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $informations = Notification::where([
                ['user_id', '=', null],
                ['isInformation', '=', 1]
            ])->orWhere([
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 1]
            ])->orderBy('created_at', 'desc')->get();
        $transactions = Notification::where([   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0]
            ])->orderBy('created_at', 'desc')->get();
        $cart_count = Cart::with('course')->where('user_id', auth()->user()->id)->count();
        return compact('notifications', 'informations', 'transactions', 'cart_count');
    }

    public static function storeImage($image, $destinationPath) {
        $ext = strtolower($image->getClientOriginalExtension());

        if (!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        while(true){
            $newName = rand(100000,PHP_INT_MAX).'.'.$ext;
            if (!file_exists($destinationPath.$newName)){
                break;
            }
        }

        if ($ext == 'jpg' || $ext == 'jpeg') {
            $img_created = ImageManager::make($image->getRealpath());
            $img_created->orientate();
            $img_created->save($destinationPath.$newName, 75);
        } else {
            $image->move($destinationPath, $newName);
        }

        return $destinationPath.$newName;
    }

    public static function storeFile($file, $destinationPath) {
        $ext = strtolower($file->getClientOriginalExtension());

        if (!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        while(true){
            $newName = rand(100000,PHP_INT_MAX).'.'.$ext;
            if (!file_exists($destinationPath.$newName)){
                break;
            }
        }
        
        $file->move($destinationPath, $newName);

        return $destinationPath.$newName;
    }

    public static function getUsableStars($user) {
        $userStars = $user->stars()->whereDate('valid_until', '>=', Carbon::today())->orderBy('created_at','asc')->get();
        
        $total_stars = 0;
        foreach($userStars as $star) {
            $total_stars += $star->stars;
        }

        return $total_stars;
    }

    public static function getUnusableStars($user) {
        $userStars = $user->stars()->whereDate('valid_until', '<=', Carbon::today())->orderBy('created_at','asc')->get();

        $total_stars = 0;
        foreach ($userStars as $star) {
            $total_stars += $star->stars;
        }

        return $total_stars;
    }

    public static function addStars($user, $star_added, $case) {
        $star               = new Star();
        $star->user_id      = $user->id;
        $star->stars        = $star_added;
        $star->valid_until  = Carbon::now()->addMonths(4);
        $star->save();

        $user->userDetail->total_stars += $star_added;
        $user->userDetail->save();

        // create notification
        $notification = Notification::create([
            'user_id'           => $user->id,
            'isInformation'     => 1,
            'title'             => 'Selamat! kamu mendapatkan '.$star_added.' stars.',
            'description'       => 'Hi, '.$user->name.'. Kamu berhasil mendapat '.$star_added.' stars dari '.$case.'! Click notifikasi ini untuk melihat star kamu.',
            'link'              => '/dashboard/redeem-vouchers'
        ]);

        Helper::checkAndUpdateUserClub($user);

        if($star && $notification)
            return 'success';
        else
            return 'error';
    }

    // Function to check & update User's club status.
    public static function checkAndUpdateUserClub($user) {
        $user_stars = $user->userDetail->total_stars;

        if ($user_stars >= 280) {
            $user->club = 'jet';
        } elseif ($user_stars >= 100) {
            $user->club = 'car';
        } elseif ($user_stars >= 20) {
            $user->club = 'bike';
        }

        $user->save();

        if ($user->wasChanged()) Mail::to($user->email)->send(new LevelUp($user));
    }

    public static function generateInvoiceNumber($length = 10) {
        try {
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            };
    
            $no_invoice = 'INV-'.Str::upper($random);

            return [
                'status' => 'Success',
                'data' => $no_invoice
            ];
        } catch (Exception $e) {
            return [
                'status' => 'Failed',
                'message' => "Caught exception: " . $e->getMessage()
            ];
        }
    }
}