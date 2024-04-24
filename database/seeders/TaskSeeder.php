<?php

namespace Database\Seeders;

use App\Jobs\SeedTasks;
use App\Models\Admin\SubTask_M;
use App\Models\Admin\Task_M;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        SeedTasks::dispatch()->onQueue('task_seeder');


    }
}
