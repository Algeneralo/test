<?php

use App\Models\Admins\PermissionGroup;
use Illuminate\Database\Seeder;

class QualitySealsPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $qualitysealss = PermissionGroup::create([
            'name' => 'Gütesiegel'
        ]);

        $qualitysealss->permissions()->insert([
            'guard_name' => 'admin',
            'name' => 'qualityseals.read',
            'displayName' => 'Gütesiegel anzeigen'

        ]);

        $qualitysealss->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'qualityseals.edit',
            'displayName' => 'Gütesiegel bearbeiten'

        ]);

        $qualitysealss->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'qualityseals.delete',
            'displayName' => 'Gütesiegel löschen'

        ]);

        $qualitysealss->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'qualityseals.create',
            'displayName' => 'Gütesiegel erstellen'

        ]);

        $qualitysealss->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'qualityseals.food',
            'displayName' => 'Gruppe Lebensmittel'

        ]);

        $qualitysealss->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'qualityseals.consmetics',
            'displayName' => 'Gruppe Kosmetika'

        ]);

        $qualitysealss->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'qualityseals.cleanser',
            'displayName' => 'Gruppe Reinigungsmittel'

        ]);

        $qualitysealss->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'qualityseals.feed',
            'displayName' => 'Gruppe Futtermittel'

        ]);



    }
}
