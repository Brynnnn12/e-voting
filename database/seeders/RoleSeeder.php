<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //membuat role admin
        $adminRole = Role::create([
            'name' => 'Admin',
        ]);

        //membuat role user
        $userRole = Role::create([
            'name' => 'User',
        ]);

        //membuat akun admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        //memberi role admin ke akun admin
        $admin->assignRole($adminRole);
    }
}
