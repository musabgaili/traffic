<?php

namespace Database\Seeders;

use App\Models\RasGroup;
use App\Models\TrafficLight;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        // create 2 rasGroups

        RasGroup::create([
            'name' => 'Current',
            'current_message' => 'none',
        ]);
        RasGroup::create([
            'name' => 'Under',
            'current_message' => 'none',
        ]);

        RasGroup::create([
            'name' => 'Future',
            'current_message' => 'none',
        ]);


        // seed ras .. 14

        for ($i = 1; $i <= 14; $i++) {
            \App\Models\Ras::create([
                // 'unique_id' =>  str_pad($i, 2, '0', STR_PAD_LEFT),
                'unique_id'=> $i,
                // 'group_id' => 1
            ]);
        }
    }
}
