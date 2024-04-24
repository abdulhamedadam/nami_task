<tr id="<?=$length?>" value="<?=$length?>" name="all_row[]">
  <td>
    <label>{{$length+1}}</label>
  </td>
    <td>
        <input style="width: 600px;" type="text" name="sub_task_name[]" class="form-control testButton "
               id="sub_task_name.<?= $length+1 ?>" value=""  />
        <span style="color: red; font-size: 14px;" class="span_error_field_msg"></span>
    </td>
    <td>
        <input style="width: 230px;" type="date" name="date[]" class="form-control " id="date.<?= $length+1 ?>"  value="" />
        <span style="color: red; font-size: 14px;" class="span_error_field_msg"></span>
    </td>
    <td>
        <input style="width: 230px;" type="time" name="time[]" class="form-control " id="time.<?= $length+1 ?>"  value="" />
        <span style="color: red; font-size: 14px;" class="span_error_field_msg"></span>
    </td>

  <td style="padding: 8px 0; text-align: center" >
      <a  style="width: 50px !important;" id="1" onclick=" $(this).closest('tr').remove();set_sum();" class="btn btn-sm btn-danger"><i class="bi bi-trash" style="color: white;"></i></a>
  </td>
</tr>
