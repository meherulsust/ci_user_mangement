<div class="box box-primary">
  <div class="box-header">
    <i class="fa fa-pencil-square-o"></i>
    <h3 class="box-title">Create User</h3>
  </div>
  <form class="ajax_submit" role="form" action="<?=$site_url . $active_controller?>/add" method="post"
    enctype="multipart/form-data">
    <table class="form_table">
      <tr>
        <td>Username :</td>
        <td>
          <input name="username" type="text" class="form-control" value="<?=set_value('username');?>" required />
          <span class='error'>* <?php echo form_error('username'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Password :</td>
        <td>
          <input name="passwd" class="form-control" type="password" value="<?=set_value('passwd');?>" />
          <span class='error'>* <?php echo form_error('passwd'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Retype Password :</td>
        <td>
          <input name="confirm_password" class="form-control" type="password"
            value="<?=set_value('confirm_password');?>" />
          <span class='error'>* <?php echo form_error('confirm_password'); ?></span>
        </td>
      </tr>
      <tr>
        <td>First Name :</td>
        <td>
          <input name="firstname" type="text" class="form-control" value="<?=set_value('firstname');?>" required />
          <span class='error'>* <?php echo form_error('firstname'); ?></span>

        </td>
      </tr>
      <tr>
        <td>Last Name :</td>
        <td>
          <input name="lastname" type="text" class="form-control" value="<?=set_value('lastname');?>" />
        </td>
      </tr>
      <tr>
        <td>Email :</td>
        <td>
          <input name="email" type="text" class="form-control" value="<?=set_value('email');?>" required />
          <span class='error'>* <?php echo form_error('email'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Mobile No. :</td>
        <td>
          <input name="mobile" type="text" class="form-control" value="<?=set_value('mobile');?>" required />
          <span class='error'>* <?php echo form_error('mobile'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Address :</td>
        <td>
          <textarea name="address" class="form-control" value="<?=set_value('address');?>"></textarea>
        </td>
      </tr>
      <tr>
        <td>Profile Picture :</td>
        <td>
          <input name="image_file" type="file" class='form-control' /> [Size (300 X 300)]
          <span class='error'></span> <?php if (!empty($upload_error)) {
    echo $upload_error;
}
?>
        </td>
      </tr>
      <tr>
        <td>Admin Group :</td>
        <td>
          <select class="form-control" name="id_admin_group" required>
            <option value="">---- Select Admin Group ----</option>
            <?php echo html_options($admin_group_options, set_value('id_admin_group')); ?>
          </select>
          <span class='error'>* <?php echo form_error('id_admin_group'); ?></span>
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