<div class="card shadow  bg-white rounded">
    <div class="card-header" style="background-color: #f8f9fa;">
        <h3 class="card-title"><i class="fas fa-text-width"></i> <?= translate('task_details') ?></h3>
    </div>
    <div class="card-body" style="padding: 20px !important;">
        <table class="table table-bordered table-sm table-striped" >
            <tbody>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('task_name') ?></td>
                <td class="class_result"><?php echo $tasks_data->name; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('task_details') ?></td>
                <td class="class_result"><?php echo $tasks_data->client_name; ?></td>
            </tr>
            <tr>
                <td class="class_label" style="width: 25%"><?= translate('status') ?></td>
                <td class="class_result"><?php echo $tasks_data->status; ?></td>
            </tr>


            </tbody>
        </table>
    </div>
</div>
