<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Companies;


class CompanyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Companies $companies)
    {
        $this->companies = $companies;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->companies->email, $this->companies->name)
            ->subject('Welcome')
            ->markdown('mails.company.created')
            ->from('admin@minicrm.com', 'MINI CRM')
            ->with('companies', $this->companies);
    }
}
