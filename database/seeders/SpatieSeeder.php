<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PDO;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);
        // $managerRole = Role::create(['name' => 'manager', 'guard_name' => 'web']);


        Role::create([
            'name' => 'project manager',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'warehouse manager',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'qa manager',
            'guard_name' => 'web',
        ]);

        // Create permissions
        $createProjectPermission = Permission::create(['name' => 'project.create']);
        $editProjectPermission = Permission::create(['name' => 'project.edit']);
        $deleteProjectPermission = Permission::create(['name' => 'project.delete']);

        $permissions = [
            "category.create",
            "category.edit",
            "category.delete",
            "user.create",
            "user.edit",
            "user.delete",
            "product.create",
            "product.edit",
            "product.delete",
            "mpr.create",
            "mpr.edit",
            "mpr.delete",
            "role.create",
            "role.edit",
            "role.delete",
        ];

        foreach ($permissions as $key => $value) {
            // dd($value);
            Permission::create(['name' => $value]);
        }


        // Assign permissions to roles
        $adminRole->givePermissionTo([$createProjectPermission, $editProjectPermission, $deleteProjectPermission]);
        $userRole->givePermissionTo([$createProjectPermission]);
    }
}
