<?php

namespace App\Mail\Backend\Admins;

use App\Models\Admins\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

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

        $this->url = URL::temporarySignedRoute('get.reset-password', now()->addMinutes(15), ['adminid' => $admin->admin_id, 'token' => $token]);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.backend.reset-password')->subject('Passwort zurücksetzen');
    }
}
