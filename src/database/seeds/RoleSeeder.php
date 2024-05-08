<?php

namespace Database\Seeders;

use App\Enums\UserRoleType;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create(['name' => "ADMINISTRATOR"]);
        Role::factory()->create(['name' => "PASSENGER"]);
    }
}
