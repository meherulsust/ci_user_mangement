		<div class="header">
		  <table>
		    <tr>
		      <td width="40%" align="right"><img src="<?php echo $base_url; ?>img/login.png" width="50" /></td>
		      <td width="50%" align="center">Admin Panel</td>
		    </tr>
		  </table>
		</div>
		<form id="login" action="<?php echo $site_url ?>login/index" method="post">
		  <div class="body bg-gray">
		    <span class="login_result"></span>
		    <div class="form-group left-inner-addon">
		      <i class="fa fa-user"></i>
		      <input style="max-width:320px!important;" type="text" name="username" class="form-control login_field"
		        placeholder="Enter Your Username" required />
		    </div>
		    <div class="form-group left-inner-addon">
		      <i class="fa fa-unlock-alt"></i>
		      <input style="max-width:320px!important;" type="password" name="passwd" class="form-control login_field"
		        placeholder="Enter Your Password" required />
		    </div>
		  </div>
		  <div class="footer">
		    <button style="max-width:320px!important; " type="submit" class="btn bg-olive btn-block">Login</button>
		  </div>
		</form>