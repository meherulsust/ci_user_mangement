<div class="box box-primary">
  <div class="box-header">
    <i class="fa fa-list-alt"></i>
    <h3 class="box-title">User Details</h3>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <span id="msg"> <?php echo $this->session->flashdata('message'); ?></span>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="user-img">
                <img src="<?=$base_url;?>upload_images/user_image/<?=(!empty($image)) ? $image : 'default.png';?>"
                  alt="User profile picture" class="profile-user-img">
              </div>
              <h3 class="profile-username text-center"><?=$full_name;?></h3>

              <p class="text-muted text-center"><?=$admin_type;?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Username</b> <a class="pull-right"><?=$username;?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?=$email;?></a>
                </li>
                <li class="list-group-item">
                  <b>Mobile</b> <a class="pull-right"><?=$mobile;?></a>
                </li>
              </ul>

              <a href="<?=$site_url . $active_controller;?>"><span class="btn btn-primary btn-block"><b>Back</b></a>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>