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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        User::where('username', 'admin')->delete();
        Role::where('name', 'superadmin')->delete();

        // admin seeder
        $superadmin = Role::create(['name' => 'superadmin']);
        $user = User::create([
            'username' => 'admin',
            'password' => 'password',
            'phone' => '85795327357',
            'phone_code' => '62',
            'email' => 'admin@admin.com',
        ]);

        $user->assignRole($superadmin);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
