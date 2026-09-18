<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'User Testing',
            'email' => 'user1@test.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        \App\Models\Ticket::create([
            'user_id' => $user->id,
            'title' => 'Laptop tidak bisa nyala',
            'description' => 'Laptop kantor mati total setelah mati listrik.',
            'category' => 'Hardware',
            'status' => 'open',
        ]);

        \App\Models\Ticket::create([
            'user_id' => $user->id,
            'title' => 'Tidak bisa akses email',
            'description' => 'Login email selalu gagal sejak pagi.',
            'category' => 'Software',
            'status' => 'in_progress',
        ]);
    }
}
