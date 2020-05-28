<div id="box">
  <?php echo $this->session->flashdata('message') ?>
  <h3 id="adduser">Change Password</h3>
  <form id="form" action="<?=$site_url . $active_controller?>/index/<?=$id;?>" method="post">
    <fieldset id="personal">
      <legend>INFORMATION</legend>
      <label for="old_passwd">Old Password : </label>
      <input name="old_passwd" type="hidden" value="<?=$passwd;?>" />
      <input name="input_old_passwd" id="old_passwd" class='text' type="password" tabindex="1" /><span
        class='req'>*</span> <?php echo form_error('input_old_passwd'); ?>
      <br />
      <label for="passwd">New Password : </label>
      <input name="new_passwd" id="passwd" class='text' type="password" tabindex="2" /><span class='req'>*</span>
      <?php echo form_error('new_passwd'); ?>
      <br />
      <label for="confirm_password">Retype Password : </label>
      <input name="confirm_password" id="confirm_password" class='text' type="password" tabindex="3" /><span
        class='req'>*</span> <?php echo form_error('confirm_password'); ?>
      <br />
    </fieldset>

    <div align="center">
      <input id="button1" type="submit" value="Save" abindex="12" />
      <input id="button2" type="reset" value='Reset' abindex="13" />
    </div>
  </form>

</div>