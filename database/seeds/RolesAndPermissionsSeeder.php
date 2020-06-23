<?php

use App\Models\Admins\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Admins\PermissionGroup;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permission Groups

        $ingredients = PermissionGroup::create([
            'name' => 'Ingredients'
        ]);

        $scannelProducts = PermissionGroup::create([
            'name' => 'Scannel Produkte'
        ]);

        $employeeManagement = PermissionGroup::create([
            'name' => 'Mitarbeiterverwaltung'
        ]);

        $appUserManagement = PermissionGroup::create([
           'name' => 'App Nutzer Verwaltung'
        ]);

        // Create Permission for Ingredients

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'ingredients.read',
            'displayName' => 'Inhaltsstoffe anzeigen'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'ingredients.edit',
            'displayName' => 'Inhaltsstoffe bearbeiten'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'ingredients.delete',
            'displayName' => 'Inhaltsstoffe löschen'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'ingredients.food',
            'displayName' => 'Gruppe Lebensmittel'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'ingredients.consmetics',
            'displayName' => 'Gruppe Kosmetika'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'ingredients.cleanser',
            'displayName' => 'Gruppe Reinigungsmittel'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'ingredients.feed',
            'displayName' => 'Gruppe Futtermittel'
        ]);


        // Mitarbeiterverwaltung

        $employeeManagement->permissions()->create([
           'guard_name' => 'admin',
           'name' => 'admins.user.read',
           'displayName' => 'Mitarbeiter anzeigen'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.user.edit',
            'displayName' => 'Mitarbeiter bearbeiten'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.user.delete',
            'displayName' => 'Mitarbeiter löschen'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.user.create',
            'displayName' => 'Mitarbeiter erstellen'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.role.read',
            'displayName' => 'Rollen anzeigen'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.role.edit',
            'displayName' => 'Rolle bearbeiten'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.role.delete',
            'displayName' => 'Rolle löschen'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.role.create',
            'displayName' => 'Rolle erstellen'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.group.read',
            'displayName' => 'Gruppen anzeigen'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.group.edit',
            'displayName' => 'Gruppe bearbeiten'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.group.delete',
            'displayName' => 'Gruppe löschen'
        ]);

        $employeeManagement->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'admins.group.create',
            'displayName' => 'Gruppe erstellen'
        ]);

        // Produkte

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'scannel-products.read',
            'displayName' => 'Scannel Produkte Anzeigen'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'scannel-products.edit',
            'displayName' => 'Scannel Produkte bearbeiten'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'scannel-products.delete',
            'displayName' => 'Scannel Produkte Löschen'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'open-products.read',
            'displayName' => 'Offene Produkte Anzeigen'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'open-products.edit',
            'displayName' => 'Offene Produkte bearbeiten'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'open-products.delete',
            'displayName' => 'Offene Produkte Löschen'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'scata-products.read',
            'displayName' => 'Scata Produkte Anzeigen'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'scata-products.edit',
            'displayName' => 'Scata Produkte bearbeiten'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'scata-products.delete',
            'displayName' => 'Scata Produkte Löschen'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'bot-products.read',
            'displayName' => 'Bot Produkte Anzeigen'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'bot-products.edit',
            'displayName' => 'Bot Produkte bearbeiten'
        ]);

        $scannelProducts->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'bot-products.delete',
            'displayName' => 'Bot Produkte Löschen'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'products.food',
            'displayName' => 'Gruppe Lebensmittel'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'products.consmetics',
            'displayName' => 'Gruppe Kosmetika'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'products.cleanser',
            'displayName' => 'Gruppe Reinigungsmittel'
        ]);

        $ingredients->permissions()->create([
            'guard_name' => 'admin',
            'name' => 'products.feed',
            'displayName' => 'Gruppe Futtermittel'
        ]);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'Administrator', 'guard_name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }


}

