<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role User sudah ada
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Buat user biasa jika belum ada
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User Test',
                'password' => bcrypt('user123'),
            ]
        );

        // Berikan role User
        if (!$user->hasRole('User')) {
            $user->assignRole($userRole);
        }
    }
}
