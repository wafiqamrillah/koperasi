<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{ Role, Permission };

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect([
            'super user',
            'developer'
        ]);

        $permissions = collect([
            'access settings',
            'update settings'
        ]);

        try {
            \DB::transaction(function () use($roles, $permissions) {
                $roles = $roles->map(function($role) {
                    return Role::firstOrCreate(['name' => $role]);
                });

                $permissions = $permissions->map(function($permission) {
                    return Permission::firstOrCreate(['name' => $permission]);
                });

                $roles->each(function($role) use($permissions) {
                    if (!in_array($role->name, ['developer', 'super user'])) {
                        $role->syncPermissions($permissions);
                    }
                });
            });
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
