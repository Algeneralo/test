<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{

    protected $table = 'permission_groups';

    protected $primaryKey = 'permission_group_id';

    protected $fillable = [
        'name'
    ];

    public function permissions() {

        return $this->hasManyThrough(Permission::class, PermissionGroupPermission::class, 'permission_group_id', 'id', 'permission_group_id', 'permission_id');

    }

}
