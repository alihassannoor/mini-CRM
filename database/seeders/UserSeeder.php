<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        User::firstOrCreate(
            ['email' => 'agent@demo.com'],
            [
                'name' => 'Sales Agent',
                'password' => Hash::make('password'),
                'role' => 'agent'
            ]
        );
        // User::create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@demo.com',
        //     'password' => Hash::make('123123'),
        //     'role' => 'admin'
        // ]);

        // User::factory()->count(5)->create(['role' => 'agent']);
    }
}
