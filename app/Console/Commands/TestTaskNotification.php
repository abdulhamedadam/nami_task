<?php

namespace App\Console\Commands;

use App\Jobs\TaskNotifcationJob;
use App\Models\Admin\SubTask_M;
use App\Models\Admin\Task_M;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestTaskNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:task-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            $currentTime = Carbon::now()->format('H:i');
            $tasks = DB::table('tbl_sub_tasks')
                ->join('tbl_tasks', 'tbl_sub_tasks.main_task_id', '=', 'tbl_tasks.id')
                ->select('tbl_tasks.*', 'tbl_sub_tasks.name as sub_task_name', 'tbl_sub_tasks.date_ar as date', 'tbl_sub_tasks.time')
                ->where('tbl_sub_tasks.time', $currentTime)
                ->get();


            //  dd($tasks);
            foreach ($tasks as $task) {
                $subTask = new SubTask_M();
                $subTask->name = $task->sub_task_name;
                $subTask->date_ar = $task->date;
                $subTask->time = $task->time;

                dispatch(new TaskNotifcationJob($subTask));
            }

            $this->info('TaskNotifcationJob dispatched successfully!');
        } catch (\Exception $e) {

            $this->error('Error dispatching TaskNotifcationJob: ' . $e->getMessage());
            Log::error('Error dispatching TaskNotifcationJob: ' . $e->getMessage());
        }
    }
}
