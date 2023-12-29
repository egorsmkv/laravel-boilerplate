<?php

declare(strict_types=1);

class CreateRolesSeeder extends CreateRolesBase
{
    public function run(): void
    {
        $this->createAdmin();
    }

    private function createAdmin(): void
    {
        $permissions = [
            'feature one',
            'feature two',
        ];

        $this->create('admin', $permissions);
    }
}
