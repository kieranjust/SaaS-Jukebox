<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seedAdminUser = [
            [
                'id' => 1,
                'name' => 'Ad Ministrator',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
        ];

        $seedManagers = [
            [
                'id' => 5,
                'name' => 'Kieran Just',
                'email' => 'kieran.just@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Adrian Gould',
                'email' => 'adrian.gould@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
        ];

        $seedAstronauts = [
            [
                'id' => 10,
                'name' => 'Eileen Dover',
                'email' => 'eileen.dover@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
            [
                'id' => 11,
                'name' => "Jacques d'Carre",
                'email' => 'jacques.dcarre@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
            [
                'id' => 12,
                'name' => 'Russel Leaves',
                'email' => 'russel.leaves@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
            [
                'id' => 13,
                'name' => 'Ivanna Vin',
                'email' => 'ivanna.vin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
            [
                'id' => 14,
                'name' => 'Win Doh',
                'email' => 'win.doh@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Password1'),
                'created_at' => now(),
            ],
        ];

        $role = Role::findByName('admin');

        foreach ($seedAdminUser as $adminSeed) {
            $user = User::create($adminSeed);
            $user->assignRole($role);
        }

        $role = Role::findByName('manager');

        foreach ($seedManagers as $managerSeed) {
            $user = User::create($managerSeed);
            $user->assignRole($role);
        }

        $role = Role::findByName('astronaut');

        foreach ($seedAstronauts as $astronautSeed) {
            $user = User::create($astronautSeed);
            $user->assignRole($role);
        }
    }
}
