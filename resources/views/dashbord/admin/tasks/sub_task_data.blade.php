@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">


            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title"></i> {{translate('sub_tasks')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.Tasks.tasks_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{translate('back')}}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-left: 0px !important;">
                    <div class="col-md-12 row">
                        <div class="col-md-8">



                            <div class="" style="margin-top: 30px">
                                @if(!empty($sub_tasks))
                                    <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr class="greentd" style="background-color: lightgrey" >
                                            <th>{{translate('m') }}</th>
                                            <th>{{ translate('sub_task') }}</th>
                                            <th>{{ translate('date') }}</th>
                                            <th>{{ translate('time') }}</th>
                                            <th>{{ translate('status') }}</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($sub_tasks as $task)

                                            <tr>
                                                <td>{{ $x++ }}</td>
                                                <td>{{ $task->name }}</td>
                                                <td class="fnt_center_blue">
                                                    {{ $task->date_ar }}
                                                </td>
                                                <td class="fnt_center_blue">{{ $task->time }}</td>
                                                <?php
                                                if ($task->status == 'finished') {
                                                    $title_approved = translate('finished');
                                                    $class_approved = 'success';
                                                    $icon_approved = '<i class="bi bi-check-circle-fill"></i>';
                                                } else {
                                                    $title_approved = translate('notfinished');
                                                    $class_approved = 'danger';
                                                    $icon_approved = '<i class="bi bi-x-circle-fill"></i>';
                                                }


                                                $status='<a  class="btn btn-'.$class_approved.' btn-sm">'.$icon_approved.' ' . $title_approved . '</a>';

                                                ?>



                                                <td class="fnt_center_black">
                                                    {!! $status !!}
                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>


                                @endif
                            </div>






                        </div>
                        <div class="col-md-4">
                            @include('dashbord.admin.tasks.task_details')

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>









@endsection

@section('js')




@endsection



