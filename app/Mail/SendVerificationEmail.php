<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;

    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.verify_user')
            ->subject('Beerly Beloved - Account Verification')
            ->with([
                'url' => 'http://ec2-13-58-20-88.us-east-2.compute.amazonaws.com/verify_user/' . $this->user->email_token,
                'name' => $this->user->first_name,
                'surname' => $this->user->last_name,
            ]);
    }
}
