<?php

namespace App\Jobs;

use App\Models\Admin;
use App\Models\Admin\SubTask_M;
use App\Models\Admin\Task_M;
use App\Notifications\TaskNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaskNotifcationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct($subTask)
    {

        $this->subTask = $subTask;
    }


    public function handle()
    {
        $admins = Admin::all();

        foreach ($admins as $admin) {
            $admin->notify(new TaskNotification($this->subTask));
        }
    }
}
