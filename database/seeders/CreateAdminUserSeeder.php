<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'   => 'Safikul Islam', 
            'email'  => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);
    
        $role = Role::create(['name' => 'Admin']);
     
        // $permissions = Permission::pluck('id','id')->all();
   
        // $role->syncPermissions($permissions);

        $user->syncRoles([$role->id]);
     
        // $user->assignRole([$role->id]);
    }
}
