<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tasks\SaveTasks_R;
use App\Models\Admin\SubTask_M;
use App\Models\Admin\Task_M;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;

class Task_C extends Controller
{
    use ValidationMessage;



    /*******************************************************/

    public function tasks_data()
    {
        //$data['notifications'] = AdminNotifications();

       // dd($notifications[0]->data['type']);
        return view('dashbord.admin.tasks.main_task_data');
    }
    /*******************************************************/
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
                ->addColumn('sub_tasks_number', function ($row) {
                    return $row->sub_tasks_count;
                })

                ->addColumn('status', function ($row) {
                     $status_arr=['finished'=>translate('finished'),'notfinished'=>translate(' notfinished ')];

                    return $status_arr[$row->status];
                })

                ->addColumn('actions', function ($row) {
                    return '<a href="'.route('admin.Tasks.edit_task',$row->id).'"class="btn btn-sm btn-warning" title="">
                          <i class="bi bi-pencil"></i>
                        </a>

                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.Tasks.delete_task',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                        <a  href="'.route('admin.Tasks.details',$row->id).'"  class="btn btn-sm btn-success">
                            <i class="bi bi-info"></i>
                        </a>';



                })->rawColumns(['actions'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*******************************************************/
    public function create_task()
    {
        //dd(now()->toTimeString());
       // dd(auth('admin')->user());

        return view('dashbord.admin.tasks.main_task_form');
    }
    /*********************************************/
    public function add_row(Request $request)
    {
        $data['length'] = $request->query('length');
        return view('dashbord.admin.tasks.add_row',$data);
    }
    /********************************************/
    public function save_task(Request $request ,Task_M $task_M,SubTask_M $subTask_M)
    {

       // dd($request);
        try {

            $request->validate([
                'task_name' => 'required',
                'descriptions' => 'required',
                'sub_task_name.*' => 'required',
            ]);
             $insertd_id=$task_M->save_main_task($request);
             $sub_tasks= $subTask_M->save_sub_tasks($request,$insertd_id);

            $data['status'] = true;
            echo json_encode($data);

        } catch (\Illuminate\Validation\ValidationException $exception) {
            $erros = $this->customErrorAjax($exception->errors());
            $data['inputerror'] = $erros['list_error'];
            $data['error_string'] = $erros['list_error_string'];
            $data['status'] = false;
            echo json_encode($data);
            exit();
        }

    }

    /*******************************************************/
    public function edit_task($id)
    {
        $data['main_task'] = Task_M::where('id', $id)->firstOrFail();
        $data['sub_tasks'] = SubTask_M::where('main_task_id', $id)->get();
        return view('dashbord.admin.tasks.main_task_edit', $data);
    }
    /********************************************************/
    public function update_task(Request $request ,Task_M $task_M,SubTask_M $subTask_M,$id)
    {
        try {

            $request->validate([
                'task_name' => 'required',
                'descriptions' => 'required',
                'sub_task_name.*' => 'required',
            ]);

            $insertd_id =$task_M->update_main_task($request,$id);
            SubTask_M::where('main_task_id', $id)->delete();
            $sub_tasks = $subTask_M->save_sub_tasks($request,$id);

            $data['status'] = true;
            echo json_encode($data);

        } catch (\Illuminate\Validation\ValidationException $exception) {
            $erros = $this->customErrorAjax($exception->errors());
            $data['inputerror'] = $erros['list_error'];
            $data['error_string'] = $erros['list_error_string'];
            $data['status'] = false;
            echo json_encode($data);
            exit();
        }

    }
    /*********************************************************/
    public function delete_task(Request $request,$id)
    {
        try{
            Task_M::where('id', $id)->delete();
            SubTask_M::where('main_task_id', $id)->delete();
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Tasks.tasks_data');
        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**************************************************/
    public function details($id)
    {
        $data['sub_tasks']   = SubTask_M::where('main_task_id','=',$id)->get();
        $data['tasks_data']  = Task_M::find($id);
        return view('dashbord.admin.tasks.sub_task_data',$data);
    }




}
