<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Companies;
use Mail;
use App\Mail\CompanyMail;

class SendCompanyMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $companies;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Companies $companies)
    {
        $this->companies = $companies;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send(new CompanyMail($this->companies));
    }
}
