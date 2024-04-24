<?php
namespace App\Jobs;

use Exception;
use App\Models\Admin\Task_M;
use App\Models\Admin\SubTask_M;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SeedTasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Task_M::factory()
                ->count(10000)
                ->create();
        } catch (Exception $e) {
            // Handle the exception (e.g., log error)
            logger()->error('Error processing SeedTasks job: ' . $e->getMessage());
        }
    }
}
