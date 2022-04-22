<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['superadmin', 'admin', 'user'];

        foreach ($roles as $role) {
            $attribute = [
                'name' => $role,
                'guard_name' => 'web',
            ];
    
            Role::create($attribute);
        }

    }
}
