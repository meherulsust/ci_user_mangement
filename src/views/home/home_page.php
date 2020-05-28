<div class="box">
	<div class="box-header">
		<h3 class="box-title">Dashboard</h3>
	</div>
	<div class="box-body">	
		<br>
		<?php
		foreach($menu as $val)
		{
		?>
		<a class="btn btn-app" href="<?php echo $site_url.$val['module_link'];?>">
			<i class="fa <?php echo $val['icon'];?>" style="font-size:70px;color:<?php echo $val['icon_color'];?>"></i>
			<?php echo $val['menu_title'];?>
		</a>
		<?php
		}
		?>
		
	</div>
</div>
