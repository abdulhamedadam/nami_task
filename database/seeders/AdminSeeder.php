<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Admin::create([
            'name' => 'nami_task',
            'email' => 'nami_task@gmail.com',
            'password' => bcrypt('102030'),
            //'roles_name' =>['owner'],
            'status' =>'active',
        ]);
    }
}
