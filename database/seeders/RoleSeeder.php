<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Role
        $user = Role::create([
            'title' => 'User',
        ]);
        $permissions = [
            [
                'route' => 'comments.*',
            ],
            [
                'route' => 'posts.index',
            ],
            [
                'route' => 'posts.show',
            ]
        ];
        $permissionId = [];
        foreach ($permissions as $data) {
            $permission = new Permission($data);
            $permission->save();
            $permissionId[] = $permission->id;
        }
        $user->permissions()->sync($permissionId);

        // Editor Role
        $editor = Role::create([
            'title' => 'Editor',
        ]);
        $permissions = [
            [
                'route' => 'posts.*',
            ],
            [
                'route' => 'comments.*',
            ]
        ];
        $permissionId = [];
        foreach ($permissions as $data) {
            $permission = new Permission($data);
            $permission->save();
            $permissionId[] = $permission->id;
        }
        $editor->permissions()->sync($permissionId);

        // Admin Role
        $admin = Role::create([
            'title' => 'Admin',
        ]);
        $permissions = [
            [
                'route' => 'posts.*',
            ],
            [
                'route' => 'comments.*',
            ]
        ];
        $permissionId = [];
        foreach ($permissions as $data) {
            $permission = new Permission($data);
            $permission->save();
            $permissionId[] = $permission->id;
        }
        $admin->permissions()->sync($permissionId);
    }
}