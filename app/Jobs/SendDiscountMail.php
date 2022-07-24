<?php

namespace App\Jobs;

use App\Mail\productDiscount;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendDiscountMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $customerEmails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customerEmails)
    {
        $this->customerEmails = $customerEmails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->customerEmails)->send(new productDiscount()); 
    }
}
