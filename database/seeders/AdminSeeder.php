<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
                    'name'=>'Admin Sir',
                    'email'=>'admin@gmail.com',
                    'password'=>Hash::make("password")
                ]);

                $role = Role::create(['name'=>'admin']);
                $permissions = Permission::pluck('id')->all();
                $role->syncPermissions($permissions);
                $user->assignRole([$role->id]);
    }
}
