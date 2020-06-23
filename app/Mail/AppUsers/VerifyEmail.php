<?php

namespace App\Mail\AppUsers;

use App\Models\Scannel\AppUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AppUser $user)
    {

        $this->user = $user;

        $this->link = URL::temporarySignedRoute(
            'verify-email',
            now()->addHours(24),
            ['lang', App::getLocale(), 'scannelid' => $user->scannelid, 'email' => $user->email]
        );

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verify-email');
    }
}
