<?php

namespace App\Mail\AppUsers;

use App\Models\Scannel\AppUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class NewAccount extends Mailable
{
    public $url;
    public $appUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AppUser $appUser, $token)
    {

        $this->appUser = $appUser;

        $this->url = URL::temporarySignedRoute('get.app.reset-password', now()->addHours(24), ['appuserid' => $appUser->id, 'token' => $token]);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.app.new-account')->subject('Für dich wurde ein Account angelegt');
    }
}
