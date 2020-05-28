<script>
$(document).ready(function() {
  $("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
    checkboxClass: 'icheckbox_minimal',
    radioClass: 'iradio_minimal'
  });
});
</script>
<div class="box box-primary">
  <div class="box-header">
    <i class="fa fa-pencil-square-o"></i>
    <h3 class="box-title">Create Menu</h3>
  </div>
  <?php echo $this->session->flashdata('message'); ?>
  <form id="ajax_submit12" role="form" action="<?=$site_url . $active_controller;?>/update_permission/" method="post">
    <table class="form_table">
      <tr>
        <td style="text-align:left !important;">Menu List</td>
        <td><b>Admin Group</b></td>
      </tr>
      <?php foreach ($menu_list as $mm) {?>
      <tr>
        <td style="text-align:left !important;"><i class="fa <?php echo $mm['icon']; ?>"></i>&nbsp;&nbsp;
          <?php echo $mm['menu_title']; ?></td>
        <td>
          <?php $admin_group = explode(',', $mm['admin_group_id']);
    foreach ($admin_group_options as $val => $lb) {
        if (in_array($val, $admin_group)) {
            $check = 'checked';
        } else {
            $check = '';
        }
        ?>
          <input type="checkbox" name="<?php echo $mm['id']; ?>[]" value="<?=$val;?>" <?php echo $check; ?> />&nbsp;
          <?php echo $lb; ?> &nbsp;&nbsp;&nbsp;&nbsp;
          <?php }?>
        </td>
      </tr>
      <?php

    if (count($mm['child']) > 0) {
        foreach ($mm['child'] as $cm) {
            ?>
      <tr>
        <td style="text-align:left !important; padding-left:30px;"><i
            class="fa <?php echo $cm['icon']; ?>"></i>&nbsp;&nbsp; <?php echo $cm['menu_title']; ?></td>
        <td>
          <?php $admin_group_child = explode(',', $cm['admin_group_id']);
            foreach ($admin_group_options as $cval => $clb) {
                if (in_array($cval, $admin_group_child)) {
                    $check_child = 'checked';
                } else {
                    $check_child = '';
                }
                ?>
          <input type="checkbox" name="<?php echo $cm['id']; ?>[]" value="<?=$cval;?>"
            <?php echo $check_child; ?> />&nbsp; <?php echo $clb; ?> &nbsp;&nbsp;&nbsp;&nbsp;
          <?php }?>
        </td>
      </tr>
      <?php }}}?>
      <tr>
        <td></td>
        <td>
          <button type="submit" class="btn btn-sm btn-primary">Update</button>
          <a href="<?=$site_url . $active_controller;?>"><span class="btn btn-sm btn-danger">Cancel</span></a>
        </td>
      </tr>
    </table>
  </form>
</div>