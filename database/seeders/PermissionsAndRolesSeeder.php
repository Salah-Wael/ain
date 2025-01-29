<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        $permissions = [
            ['id' => 1, 'name' => 'create_excuse', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'edit_excuse', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'delete_excuse', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'add_new_student', 'guard_name' => 'admin'],
            ['id' => 5, 'name' => 'edit_student', 'guard_name' => 'admin'],
            ['id' => 6, 'name' => 'delete_student', 'guard_name' => 'admin'],
            ['id' => 7, 'name' => 'approve_excuse', 'guard_name' => 'head'],
            ['id' => 8, 'name' => 'reject_excuse', 'guard_name' => 'head'],
            ['id' => 9, 'name' => 'add_new_admin', 'guard_name' => 'admin'],
            ['id' => 10, 'name' => 'edit_admin', 'guard_name' => 'admin'],
            ['id' => 11, 'name' => 'delete_admin', 'guard_name' => 'admin'],
            ['id' => 12, 'name' => 'add_new_doctor', 'guard_name' => 'admin'],
            ['id' => 13, 'name' => 'add_new_doctor', 'guard_name' => 'head'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['id' => $permission['id']], $permission);
        }

        // Roles
        $roles = [
            ['id' => 3, 'name' => 'Super-Admin', 'guard_name' => 'admin'],
            ['id' => 4, 'name' => 'Admin', 'guard_name' => 'admin'],
            ['id' => 5, 'name' => 'Student', 'guard_name' => 'web'],
            ['id' => 6, 'name' => 'Head-Of-Department', 'guard_name' => 'head'],
            ['id' => 7, 'name' => 'Doctor', 'guard_name' => 'doctor'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }

        // Role-Has-Permissions
        $roleHasPermissions = [
            ['permission_id' => 1, 'role_id' => 5],
            ['permission_id' => 2, 'role_id' => 5],
            ['permission_id' => 3, 'role_id' => 5],
            ['permission_id' => 4, 'role_id' => 3],
            ['permission_id' => 4, 'role_id' => 4],
            ['permission_id' => 5, 'role_id' => 3],
            ['permission_id' => 5, 'role_id' => 4],
            ['permission_id' => 6, 'role_id' => 3],
            ['permission_id' => 6, 'role_id' => 4],
            ['permission_id' => 7, 'role_id' => 6],
            ['permission_id' => 8, 'role_id' => 6],
            ['permission_id' => 9, 'role_id' => 3],
            ['permission_id' => 10, 'role_id' => 3],
            ['permission_id' => 11, 'role_id' => 3],
            ['permission_id' => 12, 'role_id' => 3],
            ['permission_id' => 12, 'role_id' => 4],
            ['permission_id' => 13, 'role_id' => 6],
        ];

        foreach ($roleHasPermissions as $rp) {
            $role = Role::find($rp['role_id']);
            $permission = Permission::find($rp['permission_id']);

            if ($role && $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }
}
