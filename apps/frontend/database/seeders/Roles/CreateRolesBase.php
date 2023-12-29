<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRolesBase extends Seeder
{
    /**
     * Create a role and assign permission to the role
     *
     * @param string $name
     * @param array $permissions
     */
    protected function create(string $name, array $permissions): void
    {
        $role = Role::create(['name' => $name]);

        foreach ($permissions as $permission) {
            $role->givePermissionTo(Permission::create(['name' => $permission]));
        }
    }
}
