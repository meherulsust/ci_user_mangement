<script>
$(document).ready(function() {
  $(".my-colorpicker1").colorpicker();
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
  <form id="ajax_submit12" role="form" action="<?=$site_url . $active_controller;?>/add/<?=encode($parent_id);?>"
    method="post">
    <table class="form_table">
      <tr>
        <td>Title :</td>
        <td>
          <input type="text" class="form-control" name="title" value="<?=set_value('title');?>" required />
          <span class="error">* <?php echo form_error('title'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Admin Group Permission :</td>
        <td>
          <?php
if (!empty($admin_group_options)) {
    foreach ($admin_group_options as $val => $lb) {
        ?>
          <input type="checkbox" name="admin_group_id[]" value="<?=$val;?>"
            <?=set_checkbox('admin_group_id[]', $val);?> />&nbsp; <?php echo $lb; ?> <br />
          <?php
}
}
?>
          <span class="error">* <?php echo form_error('admin_group_id[]'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Order :</td>
        <td>
          <input type="text" class="form-control" name="order" value="<?=set_value('order');?>" required />
          <span class="error">* <?php echo form_error('order'); ?></span>
        </td>
      </tr>

      <tr>
        <td>Status :</td>
        <td>
          <select name='status' class='form-control' required>
            <?php echo html_options($status_option, set_value('status')); ?>
          </select>
          <span class='error'>* <?php echo form_error('status'); ?> </span>
        </td>
      </tr>
      <tr>
        <td>Module link :</td>
        <td>
          <input name="module_link" class='form-control' type="text" value="<?=set_value('module_link');?>" required />
          <span class='error'>* <?php echo form_error('module_link'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Menu Icon :</td>
        <td>
          <input name="icon" class='form-control' type="text" value="<?=set_value('icon');?>" />
          <span class="display_icon"></span>
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Select Icon
            Class</button>
        </td>
      </tr>
      <tr>
        <td>Icon Color :</td>
        <td>
          <input name="icon_color" class='form-control my-colorpicker1' type="text"
            value="<?=set_value('icon_color');?>" />
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          <button type="reset" class="btn btn-sm btn-danger">Reset</button>
        </td>
      </tr>
    </table>
  </form>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <?php echo $this->load->element('icon_list'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>