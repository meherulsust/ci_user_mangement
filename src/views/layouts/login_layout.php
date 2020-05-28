<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="<?php echo $css_url; ?>bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $css_url; ?>font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $css_url; ?>AdminLTE.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $css_url; ?>login.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div id="bg">
    <img src="<?php echo $base_url; ?>img/login-bg.png" />
  </div>
  <div class="form-box" id="login-box">
    <?php echo $content_for_layout; ?>
  </div>
  <div id="copy-right">
    <p>All rights preserved by <a href='#'>Md.Meherul Islam</a> <?php echo date('Y') - 1 . '-' . date('Y') ?></p>
  </div>
  <script src="<?php echo $js_url; ?>jquery-2.0.2.js"></script>
  <script>
  $(document).ready(function() {
    $(document).on("submit", "#login", function() {
      $('.login_result').html('<i class="fa fa-refresh fa-spin"></i> Login ...');
      form = $("#login").serialize();
      var formURL = $(this).attr("action");
      $.ajax({
        type: "POST",
        url: formURL,
        data: form,
        success: function(data) {
          if (data == 1) {
            $('.login_result').html('<div class="alert alert-success">Login Successful...</div>');
            window.location = "<?php echo $site_url; ?>home";
          } else if (data == 2) {
            $('.login_result').html(
              '<div class="alert alert-warning">Please check home menu  access.</div>');
          } else {
            $('.login_result').html(
              '<div class="alert alert-danger"></i> Invalid username or password.</div>');
          }
        }
      });
      return false;
    });
  });
  </script>
</body>

</html>