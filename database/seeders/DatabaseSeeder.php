<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            CriteriaSeeder::class,
            ContestantSeeder::class,
            TalentCriteriaSeeder::class,
            GownCriteriaSeeder::class,
        ]);
    }
}
