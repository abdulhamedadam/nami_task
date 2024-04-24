<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'name' => 'nami_task',
            'email' => 'nami_task@gmail.com',
            'password' => bcrypt('102030'),
            'status' =>'active',
        ]);

        $user=User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('102030'),
        ]);


    }
}
