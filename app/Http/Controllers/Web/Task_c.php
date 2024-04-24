<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\SubTask_M;
use App\Models\Admin\Task_M;
use Illuminate\Http\Request;
use DataTables;

class Task_c extends Controller
{
    /*****************************************************/
    public function tasks_data()
    {

        return view('dashbord.web.tasks.main_task_data');
    }
    /*****************************************************/
    public function get_ajax_tasks(Request $request,Task_M $task_M)
    {
        if ($request->ajax()) {
            $status = $request->input('status');
            $data = $task_M->get_task_data($status);
            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('task_name', function ($row) {
                    return  $row->name;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })


                ->addColumn('status', function ($row) {
                    $status_arr=['finished'=>translate('finished'),'notfinished'=>translate(' notfinished ')];

                    return $status_arr[$row->status];
                })

                ->addColumn('actions', function ($row) {
                    return '

                        <a  href="'.route('Tasks.show_sub_tasks',$row->id).'"  class="btn btn-sm btn-success">
                            <i class="bi bi-info"></i>
                        </a>';



                })->rawColumns(['actions'])
                ->make(true);

            return $dataTable->toJson();
        }
    }

    /**************************************************************/
    public function show_sub_tasks($id)
    {
        $data['sub_tasks']   = SubTask_M::where('main_task_id','=',$id)->get();
        $data['tasks_data']  = Task_M::find($id);
        return view('dashbord.web.tasks.sub_task_data',$data);
    }
    /************************************************************/
    public function update_status(Request $request,$sub_task_id,$status,$main_task_id)
    {
        try{

            $sub_taskM=new SubTask_M();
            $sub_taskM->update_status($sub_task_id,$status,$main_task_id);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('Tasks.show_sub_tasks',$main_task_id);
        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
