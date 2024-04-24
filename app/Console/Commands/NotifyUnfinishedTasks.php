<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Admin\Task_M;
use App\Notifications\TaskNotFinishedNotification;
use Illuminate\Console\Command;

class NotifyUnfinishedTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:notify-unfinished-tasks';


    protected $description = 'Command description';


    public function handle()
    {
        $tasks = Task_M::where('status', '!=', 'finished')
            ->where('created_at', '<=', now()->subDays(2))
            ->get();

        foreach ($tasks as $task) {
            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new TaskNotFinishedNotification($task));
            }
        }
    }
}
