<?php

namespace App\Mail\Backend\Admins;

use App\Models\Admins\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class NewAccount extends Mailable
{
    public $url;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $admin, $token)
    {

        $this->admin = $admin;

        $this->url = URL::temporarySignedRoute('get.reset-password', now()->addHours(24), ['adminid' => $admin->admin_id, 'token' => $token]);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.backend.new-account')->subject('Für dich wurde ein Account angelegt');
    }
}
