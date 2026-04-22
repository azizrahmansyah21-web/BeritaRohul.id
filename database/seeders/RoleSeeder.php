<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [] ; 
        foreach(config('roles.permissions') as $permission_key => $permission_config){
            $permissions[] = $permission_key ; 
        }
        
        Role::create([
            'name' => 'Manager' , 
            'permissions' => json_encode($permissions) , 
        ]) ; 
    }
}
