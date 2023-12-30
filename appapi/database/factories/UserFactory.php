<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'address' => $this->faker->address,
            'bio' => $this->faker->paragraph(3, true),
            'age' => $this->faker->numberBetween(11, 99),
            'email' => $this->faker->email,
            'image' => $this->faker->imageUrl,
            'password' => 123456,
            //   $live =$faker->shuffle([1, 2]),
            'role' => $this->faker->randomElement([2]),
            'accounttype' => $this->faker->randomElement(['owner', 'petshooter', 'dual']),
            'accountstatus' => $this->faker->randomElement(['Active', 'Deactivated']),
            'email_verified_at' => now(),
            //  'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
