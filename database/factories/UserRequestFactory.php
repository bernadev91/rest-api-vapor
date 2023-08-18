<?php

namespace Database\Factories;

class UserRequestFactory
{
    /**
     * Create a fake request to create a new user
     */
    public static function create(): array
    {
        $password = fake()->password(8);

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => $password,
            'password_confirmation' => $password,
        ];
    }

    /**
     * Create a fake request to edit an existing user
     */
    public static function update(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
