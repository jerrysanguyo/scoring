<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dance;

class DanceSeeder extends Seeder
{
    public function run(): void
    {
        $dances = [
            'CAROLING'
        ];

        foreach ($dances as $dance) {
            Dance::firstOrcreate([
                'name' => $dance,
                'added_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
