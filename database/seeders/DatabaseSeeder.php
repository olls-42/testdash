<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Maybe Admin',
            'email' => 'test@example.com',
            'password' => '123456',
            'is_admin' => rand(0,1)
        ]);

        User::factory(25)->create();
    }
}
