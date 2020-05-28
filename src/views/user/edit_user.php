<div class="box box-primary">
  <div class="box-header">
    <i class="fa fa-pencil-square-o"></i>
    <h3 class="box-title">Edit User</h3>
  </div>
  <form role="form" action="<?php echo $site_url . $active_controller ?>/edit/<?php echo encode($id); ?>" method="post"
    enctype="multipart/form-data">
    <table class="form_table">
      <tr>
        <td>Username :</td>
        <td>
          <input name="username" type="text" class="form-control" value="<?=set_value('username', $username);?>"
            required />
          <span class='error'>* <?php echo form_error('username'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Password :</td>
        <td>
          <input name="passwd" class="form-control" type="password" value="<?=set_value('passwd');?>" />
          <span class='error'> <?php echo form_error('passwd'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Retype Password :</td>
        <td>
          <input name="confirm_password" class="form-control" type="password"
            value="<?=set_value('confirm_password');?>" />
          <span class='error'> <?php echo form_error('confirm_password'); ?></span>
        </td>
      </tr>
      <tr>
        <td>First Name :</td>
        <td>
          <input name="firstname" type="text" class="form-control" value="<?=set_value('firstname', $firstname);?>"
            required />
          <span class='error'>* <?php echo form_error('firstname'); ?></span>

        </td>
      </tr>
      <tr>
        <td>Last Name :</td>
        <td>
          <input name="lastname" type="text" class="form-control" value="<?=set_value('lastname', $lastname);?>" />
        </td>
      </tr>
      <tr>
        <td>Email :</td>
        <td>
          <input name="email" type="text" class="form-control" value="<?=set_value('email', $email);?>" required />
          <span class='error'>* <?php echo form_error('email'); ?></span>
        </td>
      </tr>
      <tr>
        <td>Mobile No. :</td>
        <td>
          <input name="mobile" type="text" class="form-control" value="<?=set_value('mobile', $mobile);?>" required />
          <span class='error'>* <?php echo form_error('mobile'); ?></span>

        </td>
      </tr>
      <tr>
        <td>Address :</td>
        <td>
          <input name="address" type="text" class="form-control" value="<?=set_value('address', $address);?>" />
        </td>
      </tr>
      <tr>
        <td>Profile Picture :</td>
        <td>
          <input name="image_file" type="file" class='form-control' /> [Size (300 X 300)]
          <span class='error'><?php echo !empty($upload_error) ? $upload_error : ''; ?></span>
        </td>
      </tr>
      <tr>
        <td>Admin Group :</td>
        <td>
          <select class="form-control" name="id_admin_group" required>
            <option value="">---- Select Admin Group ----</option>
            <?php echo html_options($admin_group_options, set_value('id_admin_group', $id_admin_group)); ?>
          </select>
          <span class='error'>* <?php echo form_error('id_admin_group'); ?></span>
        </td>
      </tr>
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