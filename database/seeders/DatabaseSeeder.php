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
        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('password');
        $admin->role = 'admin';
        $admin->save();

        $user = new User();
        $user->name = 'User Testing';
        $user->email = 'user1@test.com';
        $user->password = bcrypt('password');
        $user->role = 'user';
        $user->save();

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

        \App\Models\Ticket::create([
            'user_id' => $user->id,
            'title' => 'Internet is very slow',
            'description' => 'Pages take forever to load.',
            'category' => 'Jaringan',
            'status' => 'closed',
            'admin_note' => 'Reset the router, it is fixed now.'
        ]);
    }
}
