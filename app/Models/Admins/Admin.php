<?php

namespace App\Models\Admins;

use App\Models\Newsletter;
use App\Models\Scata\Products\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{

    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use HasApiTokens;

    protected $table = "admins";

    protected $primaryKey = "admin_id";

    protected $fillable = [
        'firstname',
        'lastname',
        'company',
        'phone_private',
        'phone_mobile',
        'sip',
        'email',
        'password',
        'lang',
        'status',
        'group_id'
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute() {

        return $this->firstname . ' ' . $this->lastname;

    }

    public function setPasswordAttribute($value) {

        $this->attributes['password'] = Hash::make($value);

    }

    public function group() {

        return $this->hasOne(Group::class, 'group_id', 'group_id');

    }

    public function newsletters() {

        return $this->hasMany(Newsletter::class, 'admin_id', 'admin_id');

    }

    public function products() {

        return $this->hasMany(Product::class, 'admin_id', 'admin_id');

    }


}
