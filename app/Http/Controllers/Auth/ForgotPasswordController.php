<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Mail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordController extends Mailable
{
    use Queueable, SerializesModels;
    public function getEmail()
    {
       return view('auth.passwords.email');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        $details = [
            'email' => 'barahenock@gmail.com',
        ];

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        // \Mail::to($request->email)->send('auth.verify',new \App\Mail\EmalaMail\ForgetPassword($details));

        Mail::send('auth.verify',['token' => $token], function($message) use ($details) {
            $message->to($details['email']);
            $message->subject('Reset Password Notification');
         });


        Toastr::success('We have e-mailed your password reset link! :)','Success');
        return back();
    }
}
