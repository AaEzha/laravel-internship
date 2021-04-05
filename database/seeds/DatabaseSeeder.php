<?php

use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;
use Modules\Member\Entities\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Member']
        ]);
    }
}
