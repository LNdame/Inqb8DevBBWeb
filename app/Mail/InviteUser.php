<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $password;

    public function __construct(User $user, $password)
    {
        //
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite_user')
            ->subject('Beerly Beloved User Account')
            ->with([
                'url' => 'http://nyiombodev.co.za/verify_email/' . $this->user->email_token,
                'name' => $this->user->name,
                'surname' => $this->user->surname,
                'user_name' => $this->user->email,
                'password' => $this->password
            ]);
    }
}
