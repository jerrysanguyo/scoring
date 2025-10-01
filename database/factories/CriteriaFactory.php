<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Criteria;
use App\Models\User;

class CriteriaFactory extends Factory
{
    protected $model = Criteria::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'added_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}
