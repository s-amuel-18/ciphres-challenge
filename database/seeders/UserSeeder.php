<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'fk_role_id' => Role::ADMIN,
                'name' => 'Test User',
                'email' => 'test@example.com',
                "password" => Hash::make("11111111")
            ],
            [
                'fk_role_id' => Role::CLIENT,
                'name' => 'Client user',
                'email' => 'client@example.com',
                "password" => Hash::make("11111111")
            ]
        ]);
    }
}
