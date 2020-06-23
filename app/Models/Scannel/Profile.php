<?php

namespace App\Models\Scannel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{

    use SoftDeletes;

    protected $table = "app_profiles";

    protected $fillable = [
        'scannelid',
        'firstname',
        'lastname',
        'gender',
        'date_of_birth',
        'phone',
        'height',
        'bodyweight',
        'allergic',
        'incompatibilities',
        'main'
    ];

    public function getNameAttribute() {

        return $this->firstname . ' ' . $this->lastname;

    }

    public function exclusionsCosmetic() {

        return $this->hasMany(ExclusionCosmetic::class,'profile_id', 'id');

    }

    public function exclusionsFood() {

        return $this->hasMany(ExclusionFood::class, 'profile_id', 'id');

    }

}
