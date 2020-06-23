<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table = 'admin_groups';

    protected $primaryKey = 'group_id';

    protected $fillable = [
        'name',
        'supervisor_id'
    ];

    public function supervisor() {

        return $this->hasOne(Admin::class, 'admin_id', 'supervisor_id');

    }

    public function admins() {

        return $this->hasMany(Admin::class, 'group_id', 'group_id');

    }

}
