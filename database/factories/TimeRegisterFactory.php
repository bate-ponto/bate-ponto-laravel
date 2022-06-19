<?php

namespace Database\Factories;

use App\Models\{TimeRegister, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeRegisterFactory extends Factory
{
    protected $model = TimeRegister::class;

    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('-1 week');

        return [
            'description' => $this->faker->boolean() ? $this->faker->text(10) : null,
            'start_time'  => $startTime,
            'end_time'    => $this->faker->dateTimeBetween($startTime, '+1 week'),
            'user_id'     => User::factory(),
        ];
    }
}
