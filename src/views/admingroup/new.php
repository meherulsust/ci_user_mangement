<div class="box box-primary">
  <div class="box-header">
    <i class="fa fa-pencil-square-o"></i>
    <h3 class="box-title">New Admin Group</h3>
  </div>
  <form id="ajax_submit12" role="form" action="<?=$site_url . $active_controller;?>/add" method="post">
    <table class="form_table">
      <tr>
        <td>Admin Group Name :</td>
        <td>
          <input type="text" class="form-control" name="title" value="<?=set_value('title');?>" required />
          <span class="error">* <?php echo form_error('title'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Description :</td>
        <td>
          <textarea name="comment" class='form-control'><?=set_value('comment');?></textarea>
        </td>
      </tr>
      <tr>
        <td>Status :</td>
        <td>
          <select class="form-control" name="status">
            <?php echo html_options($status_option, set_value('status')); ?>
          </select>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <button type="submit" class="btn btn-sm btn-primary">Create</button>
          <button type="reset" class="btn btn-sm btn-info">Reset</button>
        </td>
      </tr>
    </table>
  </form>
</div>