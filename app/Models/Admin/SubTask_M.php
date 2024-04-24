<?php

namespace App\Models\Admin;

use App\Notifications\TaskNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubTask_M extends Model
{

    use HasFactory ,Notifiable;
    protected $table = 'tbl_sub_tasks';
    protected $guarded = [];


    public function main_tasks()
    {
         return $this->belongsTo(Task_M::class,'main_task_id');
    }


    /**************************************/
    public function save_sub_tasks($request,$main_task_id)
    {
        $subTaskNames = $request->sub_task_name;
        $dates        = $request->date;
        $times        = $request->time;
        $main_task    = Task_M::find($main_task_id);

        foreach ($subTaskNames as $index => $subTaskName) {

                $subTask = new SubTask_M();
                $subTask->name         = $subTaskName;
                $subTask->date_ar      = $dates[$index];
                $subTask->date_st      = strtotime( $dates[$index]);
                $subTask->time         = $times[$index];
                $subTask->main_task_id = $main_task_id;
                $subTask->save();
              //  $subTask->notify(new TaskNotification($main_task, $subTask));


        }
    }

}
