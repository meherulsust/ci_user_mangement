<form id="ajax_submit" role="form" action="<?=$site_url . $active_controller;?>" method="post">
  <div class="box box-primary">
    <div class="box-header">
      <i class="fa fa-table"></i>
      <h3 class="box-title"><?php echo $page_title; ?></h3>
      <div class="box-tools pull-right">
        <a class="ajax_link" href="<?=$site_url . $link_action;?>">
          <button class="btn btn-primary btn-xs" type="button"><i class='fa fa-plus'></i>
            <?php echo $link_title; ?></button>
        </a>
      </div>
    </div>
    <span class="delete_message"><?php echo $this->session->flashdata('message'); ?></span>
    <?php $this->load->element('grid_board');?>
  </div>
</form>
<script type='text/javascript'>
$(document).ready(function() {
  var menuItems = [{
      title: '<i class="fa fa-check-circle text-success"> Publish</i>',
      value: 'publish'
    },
    {
      title: '<i class="fa fa-times-circle text-danger"> Unpublish</i>',
      value: 'unpublish'
    }
  ];
  $("td.stat_menu a").statusMenu({
    items: menuItems
  });
});
</script>