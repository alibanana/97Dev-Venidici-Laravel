<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

use App\Models\User;
use App\Mail\ForgetPasswordMail;

/*
|--------------------------------------------------------------------------
| CustomAuthController Class.
|
| Description:
| This controller is responsible in handling custom authentication method. 
|--------------------------------------------------------------------------
*/ 
class CustomAuthController extends Controller
{
    // Handles the forgot-password functionality.
    public function resetPassword(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user)
            return redirect(route('login') . '#forget-password')->with('danger', 'Oops, email does not exists.');

        $currentPasswordHashed = $user->password;
        $newPassword = $this->generatePassword(12);
        $user->password = Hash::make($newPassword);
        $user->save();

        if ($user->wasChanged()) {
            $messageTopic = 'success';
            $message = 'A new password has successfully been generated for your account, please check your email for further informations!';
            try {
                Mail::to($user->email)->send(new ForgetPasswordMail($newPassword));
            } catch (Throwable $e) {
                $user->password = $currentPasswordHashed;
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

        return redirect(route('login') . '#forget-password')->with($messageTopic, $message);
    }

    // Method to generate a random password of length (input).
    public function generatePassword($length) {
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
}
