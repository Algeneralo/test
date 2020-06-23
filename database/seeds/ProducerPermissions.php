<?php

use App\Models\Admins\PermissionGroup;
use Illuminate\Database\Seeder;

class ProducerPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $producers = PermissionGroup::create([
            'name' => 'Hersteller'
        ]);

        $producers->permissions()->insert([
            'guard_name' => 'admin',
            'name' => 'producer.read',
            'displayName' => 'Hersteller anzeigen'

        ]);

        $producers->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'producer.edit',
            'displayName' => 'Hersteller bearbeiten'

        ]);

        $producers->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'producer.delete',
            'displayName' => 'Hersteller löschen'

        ]);

        $producers->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'producer.create',
            'displayName' => 'Hersteller erstellen'

        ]);

        $producers->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'producer.food',
            'displayName' => 'Gruppe Lebensmittel'

        ]);

        $producers->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'producer.consmetics',
            'displayName' => 'Gruppe Kosmetika'

        ]);

        $producers->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'producer.cleanser',
            'displayName' => 'Gruppe Reinigungsmittel'

        ]);

        $producers->permissions()->insert([

            'guard_name' => 'admin',
            'name' => 'producer.feed',
            'displayName' => 'Gruppe Futtermittel'

        ]);



    }
}
