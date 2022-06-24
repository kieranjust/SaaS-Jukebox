<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create-astronaut',
            'create-genre',
            'create-playlist',
            'create-track',
            'create-user',
            'delete-astronaut',
            'delete-genre',
            'delete-own-playlist',
            'delete-private-playlist',
            'delete-public-playlist',
            'delete-track',
            'delete-user',
            'update-astronaut',
            'update-genre',
            'update-all-playlists',
            'update-own-playlist',
            'update-public-playlist',
            'update-self',
            'update-track',
            'update-user',
            'view-all-genres',
            'view-all-playlists',
            'view-all-tracks',
            'view-all-users',
            'view-astronaut',
            'view-genre',
            'view-own-playlist',
            'view-private-playlist',
            'view-self',
            'view-track',
            'view-user',
            'view-public-playlist',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            [
                'name' => 'admin',
                'permissions' => [
                    'create-user',
                    'delete-user',
                    'update-user',
                    'view-user',
                    'view-all-users',
                    'create-track',
                    'delete-track',
                    'update-track',
                    'view-track',
                    'view-all-tracks',
                    'create-genre',
                    'delete-genre',
                    'update-genre',
                    'view-genre',
                    'view-all-genres',
                    'create-playlist',
                    'delete-private-playlist',
                    'update-all-playlists',
                    'delete-public-playlist',
                    'view-all-playlists',
                ],
            ],

            [
                'name' => 'manager',
                'permissions' => [
                    'view-astronaut',
                    'delete-astronaut',
                    'update-astronaut',
                    'create-astronaut',
                    'delete-public-playlist',
                    'update-public-playlist',
                    'view-self',
                    'update-self',
                    'view-own-playlist',
                    'update-own-playlist',
                    'delete-own-playlist',
                    'view-public-playlist',
                ],
            ],

            [
                'name' => 'astronaut',
                'permissions' => [
                    'view-self',
                    'update-self',
                    'view-own-playlist',
                    'update-own-playlist',
                    'delete-own-playlist',
                    'view-public-playlist',
                ],
            ],
        ];
        foreach ($roles as $role) {
            $role_name = $role['name'];
            $theRole = Role::create(['name' => $role_name]);

            $permissions = $role['permissions'];
            foreach ($permissions as $permission) {
                $theRole->givePermissionTo($permission);
            }
        }
    }
}
