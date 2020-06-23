<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Model;

class PermissionGroupPermission extends Model
{

    protected $table = 'permission_group_permissions';

    public $incrementing = false;
    public $timestamps = false;

}
