<?php

namespace App\Models\Admin;

use App\Http\Controllers\Admin\SubTask_C;
use App\Models\Admin\SubTask_M;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Task_M extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'tbl_tasks';
    protected $guarded = [];


    public function sub_tasks()
    {
        return $this->hasMany(SubTask_M::class,'id');
    }

    /************************************/
    public function save_main_task($request)
    {
        $task = new Task_M();
        $task->name        = $request->task_name;
        $task->description = $request->descriptions;
        $task->save();
        return $task->id;
    }
    /************************************/
    public function update_main_task($request,$id)
    {
        $task = Task_M::find($id);

        if ($task) {
            $task->name = $request->task_name;
            $task->description = $request->descriptions;
            $task->save();
        } else {
            return false;
        }
    }

    /***************************************/
    public function get_task_data($status)
    {
        $query = Task_M::select('tbl_tasks.id', 'tbl_tasks.name','tbl_tasks.status', 'tbl_tasks.description');
        if ($status === 'finished' || $status === 'notfinished') {
            $query->where('tbl_tasks.status', '=', $status);
        }

        return $query->get();
    }


}
