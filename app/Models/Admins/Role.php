<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    protected $fillable = [
        'guard_name',
        'group_id',
        'name'
    ];

    public function group() {

        return $this->hasOne(Group::class, 'group_id', 'group_id');

    }

}
