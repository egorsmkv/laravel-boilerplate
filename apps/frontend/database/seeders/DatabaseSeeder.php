<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private function load(): void
    {
        require __DIR__ . '/Roles/CreateRolesBase.php';
        require __DIR__ . '/Roles/CreateRolesSeeder.php';
    }

    public function run(): void
    {
        $this->load();

        $this->call(CreateRolesSeeder::class);
    }
}
