<?php

namespace App\Jobs;

use App\Establishment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendAdminMailApprovals implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new \App\Mail\SendAdminApprovalMail($this->user, $this->establishment);

        Mail::to('Ls20045@gmail.com')->send($email);
        $this->release(2);
    }
}
