<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ListsTableSeeder::class);
        $this->call(ItemsInListsTableSeeder::class);
    }
}
