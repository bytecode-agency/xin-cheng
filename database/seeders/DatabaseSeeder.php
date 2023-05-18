<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
       
            Permission::create(['name' => 'create-users']);
            Permission::create(['name' => 'edit-users']);
            Permission::create(['name' => 'delete-users']);
    
            Permission::create(['name' => 'view-users']);
  
          
    
            $superadminRole = Role::create(['name' => 'SuperAdmin']);
        
    
            $superadminRole->givePermissionTo([
                'create-users',
                'edit-users',
                'delete-users',
                'view-users'
             
            ]);
    
        
    
            $user = \App\Models\User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('12345678')
            ]);
            $user->assignRole($superadminRole);
    
   
        
    }
}
