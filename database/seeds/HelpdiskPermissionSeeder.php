<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Admins\PermissionGroup;

class HelpdiskPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $helpDiskGroup = PermissionGroup::create([
            'name' => 'Helpdesk',
        ]);
        $read = $helpDiskGroup->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'helpDisk.read',
            'displayName' => 'Helpdesk anzeigen',
        ]);
        $create = $helpDiskGroup->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'helpDisk.create',
            'displayName' => 'Helpdesk erstellen',
        ]);
        $edit = $helpDiskGroup->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'helpDisk.edit',
            'displayName' => 'Helpdesk bearbeiten',
        ]);

        $delete = $helpDiskGroup->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'helpDisk.delete',
            'displayName' => 'Helpdesk löschen',
        ]);
        \App\Models\Admins\PermissionGroupPermission::query()->insert([
            [
                "permission_group_id" => $helpDiskGroup->permission_group_id,
                "permission_id" => $create->id,
            ], [
                "permission_group_id" => $helpDiskGroup->permission_group_id,
                "permission_id" => $edit->id,
            ], [
                "permission_group_id" => $helpDiskGroup->permission_group_id,
                "permission_id" => $read->id,
            ], [
                "permission_group_id" => $helpDiskGroup->permission_group_id,
                "permission_id" => $delete->id,
            ],
        ]);
    }
}
