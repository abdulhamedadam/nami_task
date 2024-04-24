<?php

namespace Database\Seeders;

use App\Models\MainData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MainData::factory()->count(1)->create();
    }
}
