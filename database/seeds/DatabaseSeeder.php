<?php
// namespace Database\Seeders;

use App\Role;
use App\User;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

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
            ['name' => 'Administrator'],
            ['name' => 'Member'],
            ['name' => 'Perusahaan'],
        ]);

        User::insert([
            ['name' => 'Administrator', 'role_id' => 1, 'email' => 'admin@gmail.com', 'password' => bcrypt('password')],
            ['name' => 'Member', 'role_id' => 2, 'email' => 'member@gmail.com', 'password' => bcrypt('password')],
        ]);
    }
}
