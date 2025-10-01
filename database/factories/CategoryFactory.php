<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'added_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}
