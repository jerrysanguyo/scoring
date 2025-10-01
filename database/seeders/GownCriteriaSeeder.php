<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GownCriteria;

class GownCriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $criterias = [
            ['name' => 'Stage presence & pose', 'Percentage'=> 40],
            ['name' => 'Movement & walk', 'Percentage'=> 30],
            ['name' => 'Overall appearance', 'Percentage'=> 30],
        ];

        foreach ($criterias as $criteria) {
            GownCriteria::firstOrCreate([
                'name' => $criteria['name'],
                'Percentage' => $criteria['Percentage'],
                'added_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
