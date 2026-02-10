<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $bossRole = Role::firstOrCreate(['name' => 'boss']);

        $permissions = [
            'dashboard.index' => [$adminRole, $bossRole],
            'dashboard.requests.index' => [$adminRole, $bossRole],
            'dashboard.requests.show' => [$adminRole, $bossRole],
            'dashboard.requests.edit' => [$adminRole, $bossRole],
            'dashboard.requests.update' => [$adminRole, $bossRole],
            'dashboard.requests.create' => [$adminRole],
            'dashboard.tags.index' => [$adminRole],
            'dashboard.users.index' => [$adminRole],
            'requests.create.public' => [$userRole],
            'requests.show.public' => [$userRole],
            'requests.edit.public' => [$userRole],
            'requests.update' => [$userRole],
            'requests.destroy' => [$userRole],
        ];

        foreach ($permissions as $permission => $roles) {
            Permission::firstOrCreate(['name' => $permission])->syncRoles($roles);
        }

    }
}
