<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dance;
use App\Models\User;

class DancesFactory extends Factory
{
    protected $model = Dance::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'added_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}
