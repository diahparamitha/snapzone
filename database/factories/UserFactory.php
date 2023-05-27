<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        return [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'role' => $faker->randomElement(['admin', 'staff', 'pengguna']),
            'phone' => $faker->numerify('08##########'),
            'address' => $faker->address,
            'password' => bcrypt('password'),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
