<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\TaskNotifcationJob;
use App\Models\Admin\SubTask_M;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksNotification_C extends Controller
{
    public function sub_tasks_time_notifications()
    {
        $currentTime = Carbon::now()->format('H:i');
        $tasks = DB::table('tbl_sub_tasks')
            ->join('tbl_tasks', 'tbl_sub_tasks.main_task_id', '=', 'tbl_tasks.id')
            ->select('tbl_tasks.*', 'tbl_sub_tasks.name as sub_task_name', 'tbl_sub_tasks.date_ar as date', 'tbl_sub_tasks.time')
            ->where('tbl_sub_tasks.time', $currentTime)
            ->get();


      //  dd($tasks);
        foreach ($tasks as $task) {
           // dd($task);
            dispatch(new TaskNotifcationJob($task));
        }


    }

    /*****************************************/

}
