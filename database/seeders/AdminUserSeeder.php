<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            [
                'email' => 'jsanguyo1624@gmail.com',
            ],
            [
                'name' => 'Jerry Sanguyo',
                'password' => bcrypt('adminpassword'),
                'type' => 'admin',
            ]
        );
        
        $judges = [
            ['name' => 'Judge1', 'email' => 'judge1@gmail.com', 'password' => bcrypt('judge1234'),'type' => 'judge'],
            ['name' => 'Judge2', 'email' => 'judge2@gmail.com', 'password' => bcrypt('judge1234'),'type' => 'judge'],
            ['name' => 'Judge3', 'email' => 'judge3@gmail.com', 'password' => bcrypt('judge1234'),'type' => 'judge'],
            ['name' => 'Judge4', 'email' => 'judge4@gmail.com', 'password' => bcrypt('judge1234'),'type' => 'judge'],
            ['name' => 'Judge5', 'email' => 'judge5@gmail.com', 'password' => bcrypt('judge1234'),'type' => 'judge'],
        ];

        foreach($judges as $judge)
        {
            User::firstOrcreate(
                [
                    'email' => $judge['email']
                ],
                [
                    'name' => $judge['name'],
                    'password' => $judge['password'],
                    'type' => $judge['type'],
                ]
            );
        }
    }
}