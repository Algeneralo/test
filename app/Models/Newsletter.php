<?php

namespace App\Models;

use App\Models\Admins\Admin;
use App\Models\Admins\Group;
use App\Models\Scannel\AppUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Newsletter extends Model
{

    protected $table = "newsletter";

    protected $fillable = [
        'admin_id',
        'receiver',
        'subject',
        'message',
        'sent'
    ];

    public function setMessageAttribute($value)
    {
        $this->attributes['message'] = htmlentities(htmlspecialchars($value));
    }

    public function getMessageAttribute($value) {

        return html_entity_decode(htmlspecialchars_decode($value));

    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }

    public function send()
    {

        switch ($this->receiver) {
            case 'app-users':

                Mail::to(AppUser::where('newsletter_verified_at', '!=', null)->get())->send(new \App\Mail\Newsletter($this));

                break;

            case 'employee':

                Mail::to(Admin::all())->send(new \App\Mail\Newsletter($this));

                break;

            default:

                Mail::to(Group::find($this->receiver)->admins()->get())->send(new \App\Mail\Newsletter($this));

                break;

        }

        $this->sent = true;
        $this->save();

    }

}
