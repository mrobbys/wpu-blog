<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Robby Setiawan',
            'username' => 'robbys',
            'email' => 'robbys@example.com',
            'password' => bcrypt('password')
        ]);

        \App\Models\User::factory(5)->create();
    }
}
