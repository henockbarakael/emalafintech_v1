<?php

namespace App\Mail\EmalaMail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from EmalaFintech.com')
                    ->view('emails.emalafintech');
    }

    // public function resetPassword(){
    //      $email = $request->email;
    // Mail::to($email)->send(new customMail());

    // if( count(Mail::failures()) > 0 ){
    //     session::flash('message','There seems to be a problem. Please try again in a while');
    //    return redirect()->back();
    // }else{
    //     session::flash('message','Thanks for your message. Please check your mail for more details!');
    //     return redirect()->back();
    // }
   // }
}
