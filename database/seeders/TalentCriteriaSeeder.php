<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TalentCriteria;

class TalentCriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $criterias = [
            ['name' => 'Stage presence & confidence', 'Percentage'=> 30],
            ['name' => 'Originality & creativity', 'Percentage'=> 30],
            ['name' => 'Presentation', 'Percentage'=> 40],
        ];

        foreach ($criterias as $criteria) {
            TalentCriteria::firstOrCreate([
                'name' => $criteria['name'],
                'Percentage' => $criteria['Percentage'],
                'added_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
