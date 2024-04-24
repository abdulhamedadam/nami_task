<?php

namespace App\Console;

use App\Console\Commands\DeleteCompletedTasks;
use App\Console\Commands\NotifyUnfinishedTasks;
use App\Console\Commands\TestJobExecution;
use App\Console\Commands\TestTaskNotification;
use App\Jobs\TaskNotifcationJob;
use App\Models\Admin\SubTask_M;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        TestJobExecution::class,
        TestTaskNotification::class,
        DeleteCompletedTasks::class,
        NotifyUnfinishedTasks::class
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $this->sub_tasks_time_notifications();
        })->everyMinute();

        $schedule->command('tasks:delete_completed_tasks')->everyMinute();
        $schedule->command('tasks:notify-unfinished-tasks')->daily();
    }


    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /*******************************************/
    public function sub_tasks_time_notifications()
    {
        $currentTime = Carbon::now()->format('H:i');
        $tasks = DB::table('tbl_sub_tasks')
            ->join('tbl_tasks', 'tbl_sub_tasks.main_task_id', '=', 'tbl_tasks.id')
            ->select('tbl_tasks.*', 'tbl_sub_tasks.name as sub_task_name', 'tbl_sub_tasks.date_ar as date', 'tbl_sub_tasks.time','tbl_sub_tasks.status')
            ->where('tbl_sub_tasks.time', $currentTime)
            ->get();
        foreach ($tasks as $task) {
            dispatch(new TaskNotifcationJob($task));
        }


    }

    /*******************************************/
}
