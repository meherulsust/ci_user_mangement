<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?php echo $page_title; ?></title>
  <script type="text/javascript">
  var site_url = '<?php echo $site_url; ?>';
  </script>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="<?php echo $css_url; ?>bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $css_url; ?>font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $css_url; ?>datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $css_url; ?>colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $css_url; ?>AdminLTE.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo $js_url; ?>jquery-2.0.2.js"></script>
  <script src="<?php echo $js_url; ?>bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo $js_url; ?>bootbox.min.js"></script>
  <script src="<?php echo $js_url; ?>plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
  <script src="<?php echo $js_url; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  <script src="<?php echo $js_url; ?>AdminLTE/app.js" type="text/javascript"></script>
  <script src="<?php echo $js_url; ?>jquery.statusmenu.js" type="text/javascript"></script>
  <?php echo $this->tpl->custom_head(); ?>
</head>

<body class="skin-blue fixed">
  <header class="header">
    <a href="<?php echo $base_url; ?>" class="logo">
      Admin Panel
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-right">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i><img
                  src="<?php echo $base_url; ?>upload_images/user_image/<?php echo ($this->session->userdata('image')) ? $this->session->userdata('image') : 'default.png'; ?>"
                  class="img-circle" width="15" alt="User Image" /></i>
              <span><?php echo $userdata['firstname'] . ' ' . $userdata['lastname']; ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header bg-light-blue">
                <img
                  src="<?php echo $base_url; ?>upload_images/user_image/<?php echo ($this->session->userdata('image')) ? $this->session->userdata('image') : 'default.png'; ?>"
                  class="img-circle" alt="User Image" />
                <p>
                  <?php echo $userdata['firstname'] . ' ' . $userdata['lastname']; ?>
                  <small><?php echo $userdata['admin_type']; ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $site_url; ?>user/view/<?=encode($this->session->userdata('admin_userid'));?>"
                    class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $site_url; ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas">
      <section class="sidebar">
        <?php echo $top_menu_html; ?>
      </section>
    </aside>
    <aside class="right-side">
      <div class="loading">
        <div class="overlay"></div>
        <div class="loading-img"></div>
      </div>
      <section class="content">
        <?php echo $content_for_layout; ?>
      </section>
      <div style="text-align: center; color:#000">
        <p>All rights preserved by <a href='#'>Md.Meherul Islam</a> <?php echo date('Y') - 1 . '-' . date('Y') ?></p>
      </div>
    </aside>
  </div>
</body>

<script>
$(document).ready(function() {

  $('.loading').hide();
  $(document).on("submit", "#ajax_submit", function() {
    $('.loading').show();
    form = $("#ajax_submit").serialize();
    var formURL = $(this).attr("action");
    $.ajax({
      type: "POST",
      url: formURL,
      data: form,
      success: function(data) {
        $('.content').html(data);
        $('.loading').hide();
      }
    });
    return false;
  });

  $(document).on("change", "#rec_per_page", function() {
    $('#ajax_submit').submit();
  });

  $(document).on("click", ".pagination a", function() {
    var url = $(this).attr('href');
    $('#ajax_submit').attr('action', url).submit();
    return false;
  });

  $(document).on("click", "#grid-board th a", function() {
    var url = $(this).attr('href');
    $('#ajax_submit').attr('action', url).submit();
    return false;
  });

  $(document).on("click", ".short a", function() {
    var url = $(this).attr('href');
    $('#ajax_submit').attr('action', url).submit();
    return false;
  });

  $(document).on("click", ".actn-btn a.del", function() {
    var message = "Are you sure you want to remove this item?\n Note: item can not be restored after removal!";
    if (confirm(message)) {
      var page_url = $(this).attr('href');
      var parent = $(this).parent().parent();
      $.ajax({
        type: "POST",
        url: page_url,
        data: '',
        cache: false,
        success: function(data) {
          var obj = jQuery.parseJSON(data);
          if (obj.status == 1) {
            parent.fadeOut('slow', function() {
              $(this).remove();
            });
            $('.delete_message').html(obj.message);
          } else {
            $('.delete_message').html(obj.message);
          }
          $('.alert').fadeOut(3000);
        }
      });
      return false;
    }
    return false;
  });


  $(document).on("click", ".change_status_menu", function() {
    var page_url = $(this).attr('href');
    var parent = $(this).parent().parent();
    $.ajax({
      type: "POST",
      url: page_url,
      data: '',
      cache: false,
      success: function(data) {
        var obj = jQuery.parseJSON(data);
        if (obj.status == 1) {
          $('.dropdown-menu').fadeOut();
          $('.stat_menu_id_' + obj.id + ' a').html(obj.data);
          $('.delete_message').html(obj.message);
        } else {
          $('.dropdown-menu').fadeOut();
          $('.delete_message').html(obj.message);
        }
        $('.alert').fadeOut(3000);
      }
    });
    return false;
  });

  setTimeout(function() {
    $('.alert').fadeOut();
  }, 2000);

});
</script>

</html>