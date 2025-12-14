<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User;

/** @extends Factory<User> */
class UserFactory extends Factory
{
    /** @var class-string<User> */
    protected $model = User::class;

    public function definition(): array
    {
        return [];
    }
}
