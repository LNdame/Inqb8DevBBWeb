<?php

namespace App\Mail;

use App\Establishment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAdminApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $establishment;

    public function __construct(User $user, Establishment $establishment)
    {
        //
        $this->user = $user;
        $this->establishment = $establishment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_approval')->subject('Beerly Beloved - Establishment Approval')->with([
            'url' => 'http://ec2-13-58-20-88.us-east-2.compute.amazonaws.com/approve_establishment/' . $this->establishment->id,
            'name' => $this->user->first_name,
            'surname' => $this->user->last_name,
            'establishment' => $this->establishment
        ]);
    }
}
