<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contestant;
use App\Models\Category;
use App\Models\Dance;
use App\Models\User;

class ContestantFactory extends Factory
{
    protected $model = Contestant::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'barangay' => $this->faker->randomElement(['TUKTUKAN', 'EAST REMBO', 'IBAYO', 'KATUPARAN', 'NORTH SIGNAL', 'PINAGSAMA', 'RIZAL', 'STA. ANA', 'USUSAN', 'WAWA', 'CENTRAL SIGNAL', 'FORT BONIFACIO', 'LIGID TIPAS', 'LOWER BICUTAN', 'NORTH DAANG HARI', 'PALINGON', 'PEMBO', 'WESTERN BICUTAN', 'BAGUMBAYAN', 'BAMBANG', 'CALZADA', 'CENTRAL BICUTAN', 'COMEMBO', 'NEW LOWER BICUTAN', 'POST PROPER SOUTH SIDE', 'WEST REMBO', 'NAPINDAN', 'PITOGO', 'POST PROPER NORTH SIDE', 'SAN MIGUEL', 'SOUTH DAANG HARI', 'SOUTH SIGNAL', 'TANYAG', 'UPPER BICUTAN']),
            'focal_person' => $this->faker->name,
            'no_of_members' => $this->faker->numberBetween(20, 50),
            'folk_dance_id' => Category::factory(),
            'dance_id' => Dance::factory(),
            'added_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }
}
