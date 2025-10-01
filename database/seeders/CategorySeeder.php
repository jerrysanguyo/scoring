<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; 

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'CAROLING'
        ];

        foreach ($categories as $category) {
            Category::firstOrcreate([
                'name' => $category,
                'added_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
