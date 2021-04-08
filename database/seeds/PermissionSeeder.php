<?php

use App\Module;
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dashboard Management Permission seeder create
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard'
        ]);


        // Role Management Permission seeder create
        $moduleAppRole = Module::updateOrCreate(['name' => 'Role Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Access Role',
            'slug' => 'app.roles.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Create Role',
            'slug' => 'app.roles.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Edit Role',
            'slug' => 'app.roles.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Delete Role',
            'slug' => 'app.roles.destroy'
        ]);


        // User Management Permission seeder create
        $moduleAppUser = Module::updateOrCreate(['name' => 'User Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Access User',
            'slug' => 'app.users.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Create User',
            'slug' => 'app.users.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Edit User',
            'slug' => 'app.users.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Delete User',
            'slug' => 'app.users.destroy'
        ]);


        // Backups Permission seeder create
        $moduleAppBackup = Module::updateOrCreate(['name' => 'Backups']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBackup->id,
            'name' => 'Access Backups',
            'slug' => 'app.backups.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBackup->id,
            'name' => 'Create Backup',
            'slug' => 'app.backups.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBackup->id,
            'name' => 'Download Backup',
            'slug' => 'app.backups.download'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBackup->id,
            'name' => 'Delete Backup',
            'slug' => 'app.backups.destroy'
        ]);


    }
}
