<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        
        $user1 = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'editing',
            'email' => 'editing@test.com',
        ]);

        $roleEditing = Role::create(['name' => 'editing']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $user1->assignRole($roleAdmin);
        $user2->assignRole($roleEditing);
    }
}
