<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RegisterUser;
use Illuminate\Support\Facades\Mail;

class UserRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $tries = 3;
    private mixed $userRegister;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userRegister)
    {
        $this->userRegister = $userRegister;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send(new RegisterUser((object)$this->userRegister));
    }
}
