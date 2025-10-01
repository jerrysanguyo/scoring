<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contestant;
use App\Models\Category;
use App\Models\Dance;
use App\Models\User;

class ContestantSeeder extends Seeder
{
    public function run(): void
    {
        $contestants = [
            'Venice Pascua', 
            'Lance Camodoc', 
            'Azalia Keite Holganza',
            'Alexa Femara Peña',
            'Celiene Nicole Fresco',
            'Mark Cyruh Malinay',
            'Tristan Tañedo',
            'Jamillah Robiños',
        ];

        foreach ($contestants as $contestant) {
            Contestant::firstOrcreate([
                'name' => $contestant,
                'added_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
