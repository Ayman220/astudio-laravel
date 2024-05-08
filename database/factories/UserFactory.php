<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'testmail@domain.com',
            'dob' => fake()->date(),
            'gender' => 1,
            'email' => 'testmail@domain.com',
            'password' => Hash::make('ASDqwe987'),
            'remember_token' => Str::random(10),
        ];
    }

}
