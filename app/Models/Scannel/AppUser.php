<?php

namespace App\Models\Scannel;

use App\Models\ScataOld\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AppUser extends Authenticatable
{

    use Notifiable;
    use HasApiTokens;
    use SoftDeletes;

    protected $table = "app_users";
    protected $connection = "mysql";

    protected $fillable = [
        'email',
        'password',
        'scannelid',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profiles() {

        return $this->hasMany(Profile::class, 'user_id', 'id');

    }


}
