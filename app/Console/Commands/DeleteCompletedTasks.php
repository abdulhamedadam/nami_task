<?php

namespace App\Console\Commands;

use App\Models\Admin\SubTask_M;
use App\Models\Admin\Task_M;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteCompletedTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:delete_completed_tasks';

    protected $description = 'Command description';

    public function handle()
    {
        $twoDaysAgo = Carbon::now()->subDays(2);
        $tasksToDelete = Task_M::where(function ($query) use ($twoDaysAgo) {
            $query->where('status', 'finished')
                ->orWhere('created_at', '<', $twoDaysAgo);
        })->get();

        foreach ($tasksToDelete as $task) {
            SubTask_M::where('main_task_id','=',$task->id)->delete();
            $task->delete();
            $this->info("Deleted task ID {$task->id} and its subtasks.");
        }

        $this->info('Completed task deletion process.');
    }
}
