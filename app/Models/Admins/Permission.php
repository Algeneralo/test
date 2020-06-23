<?php

namespace App\Models\Admins;


use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Contracts\Permission as SpatiePermissionContract;

class Permission extends SpatiePermission
{


    protected $fillable = [
        'name',
        'guard',
        'displayName',
        'description'
    ];

}
