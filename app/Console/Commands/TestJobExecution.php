<?php

namespace App\Console\Commands;

use App\Models\Admin\Task_M;
use Illuminate\Console\Command;
use App\Jobs\SeedTasks;

class TestJobExecution extends Command
{
    protected $signature = 'test:job';

    protected $description = 'Manually test job execution';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $task = Task_M::first();
        $job = new SeedTasks($task);
        $job->handle();

        $this->info('Job executed successfully.');
    }
}
