<?php

namespace App\Mail;
use App\User;
use Crypt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //generate link
        $encryptedEmail = Crypt::encrypt($this->user->email);

        $link = route('daftar.verify', ['token' => $encryptedEmail]);

        return $this->subject('Verify Your Email Address')
            ->with('link', $link)
            ->view('email.signup');
    }
}
