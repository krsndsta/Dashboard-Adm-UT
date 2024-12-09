<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'Administrator',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $user = new User([
            'name' => 'Administrator',
            'email' => 'administrator@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('administrator'),
        ]);
        $user->save();
        $user->assignRole('Administrator');

        UserDetail::create([
            'user_id' => $user->id
        ]);
    }
}
