@extends('dashbord.layouts.master')
@section('css')

@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container" >
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{translate('edit_task')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.Tasks.tasks_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{translate('back')}}
                            </a>
                        </div>
                    </div>
                </div>

                <form id="taskForm" >
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row" >

                            <div class="col-md-6">
                                <label for="basic-url" class="form-label">{{ translate('task_name') }}</label>

                                <input type="text" class="form-control" name="task_name" id="task_name" value="{{ old('task_name',$main_task->name) }}" aria-describedby="basic-addon3">

                                <span style="color: red; font-size: 14px;" class="span_error_field_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ translate('descriptions') }}</label>
                                <textarea class="form-control" id="descriptions" name="descriptions" rows="3" >{{ old('descriptions',$main_task->description) }}</textarea>
                                <span style="color: red; font-size: 14px;" class="span_error_field_msg"></span>
                            </div>
                        </div>


                        <br>
                        <br>
                        <br>
                        <br>
                        <input type="hidden" name="row_nums" id="row_nums" value="0">
                        <div class="row ">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered"  id="mytable"  >
                                    <thead style="background-color: #dddde5">
                                    <tr class="info">
                                        <th style="text-align: center;"> {{translate('m')}} </th>
                                        <th style="text-align: center;"> {{translate('sub_task_name')}} </th>
                                        <th style="text-align: center;">{{translate('date')}}</th>
                                        <th style="text-align: center;"> {{translate('time')}}</th>
                                        <th style="text-align: center;"> {{translate('action')}}</th>
                                    </tr>
                                    </thead>

                                    <tbody id="resultTable">
                                    <?php
                                    $y=1;
                                    ?>
                                    <input type="hidden" name="rows[]" value="<?=$y?>" id="rows">
                                    @foreach ($sub_tasks as $key=>$task)
                                        <tr>
                                            <td>
                                                <label>{{ $y++ }}</label>
                                            </td>
                                            <td>
                                                <input style="width: 600px;" type="text" name="sub_task_name[]" class="form-control testButton"
                                                       id="sub_task_name.{{ $task->id}}" value="{{$task->name}}" data-validation="required"/>
                                                <span style="color: red; font-size: 14px;" class="span_error_field_msg"></span>
                                            </td>
                                            <td>
                                                <input style="width: 230px;" type="date" name="date[]" value="{{$task->date_ar}}" class="form-control" id="date.{{ $task->id }}"
                                                       value=""/>
                                                <span style="color: red; font-size: 14px;" class="span_error_field_msg"></span>
                                            </td>
                                            <td>
                                                <input style="width: 230px;" type="time" name="time[]" value="{{$task->time}}"  class="form-control" id="time.{{ $task->id }}"
                                                       value=""/>
                                                <span style="color: red; font-size: 14px;" class="span_error_field_msg"></span>
                                            </td>
                                            <td>
                                                @if($key > 4)
                                                <a  style="width: 50px !important;" id="1" onclick=" $(this).closest('tr').remove();" class="btn btn-sm btn-danger"><i class="bi bi-trash" style="color: white;"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>

                                    <th class="text-center" style="background-color: #fff; ">
                                        <button type="button" onclick="add_row()" id="addRowBtn" class="btn btn-sm btn-success btn-next" />
                                        <i class="bi bi-plus fs-2"></i>
                                        </button>

                                    </th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group text-end" style="margin-top: 27px;">
                                <button type="button" onclick="save()" name="btnSave" value="btnSave" id="btnSave" class="btn btn-success btn-flat ">
                                    <i class="bi bi-save"></i> {{ translate('SaveButton') }}
                                </button>
                            </div>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>








@endsection

@section('js')


    <script>
        function save() {
            $('#btnSave').text('{{translate("load_process")}}');
            $('#btnSave').prop('disabled', true);

            var formData = new FormData($('#taskForm')[0]);

            console.log('formData'+formData);

            $.ajax({
                url: '{{route("admin.Tasks.update_task",$main_task->id)}}',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (data) {
                    console.log(data.status);
                    if (data.status) {

                        window.location.href = "{{ route('admin.Tasks.tasks_data') }}";
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[id="' + data.inputerror[i] + '"]').parent().parent().addClass('is-invalid');
                            $('[id="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                        }
                    }
                    $('#btnSave').text('{{translate("SaveButton")}}');
                    $('#btnSave').attr('disabled', false);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#btnSave').text('{{translate("SaveButton")}}');
                    $('#btnSave').prop('disabled', false);
                }
            });
        }
    </script>


    <script>
        function add_row() {
            $("#mytable").show();
            var arr = [];
            var x = document.getElementById('resultTable');
            var length = x.rows.length ;
            var row = arr.push(length);
            $("#rows").val(row);
            var dataString = 'length=' + length;
            $.ajax({
                type: 'get',
                url: '{{route('admin.Tasks.add_row')}}',
                data: dataString,
                dataType: 'html',
                cache: false,
                success: function (html) {
                    $("#resultTable").append(html);

                }
            });
        }
    </script>





    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#related_folder").trigger("change");
                $("#desk_id").trigger("change")
            }, 300);
        });
    </script>

    <script>
        function get_related_data()
        {

        }
    </script>


    <script>
        function get_related_data(id)
        {
            $.ajax({

                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#related_entity_id').html(html);
                },
            });
        }
    </script>
@endsection



