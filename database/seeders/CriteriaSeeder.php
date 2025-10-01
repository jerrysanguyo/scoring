<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Criteria;

class CriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $criterias = [
            ['name' => 'A. Overall appearance', 'percentage' => 25],
            ['name' => 'B. Fit and style', 'percentage' => 25],
            ['name' => 'C. Creativity & personality', 'percentage' => 20],
            ['name' => 'D. Confidence & stage personality', 'percentage' => 30]
        ];
    
        foreach ($criterias as $criteria) {
            Criteria::firstOrcreate([
                'name' => $criteria['name'],
                'percentage' => $criteria['percentage'],
                'added_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
