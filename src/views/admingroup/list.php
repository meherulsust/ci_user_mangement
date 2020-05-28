<form id="ajax_submit" role="form" action="<?=$site_url . $active_controller;?>" method="post">
  <div class="box box-primary">
    <div class="box-header">
      <i class="fa fa-table"></i>
      <h3 class="box-title">Admin Group List</h3>
    </div>
    <span class="delete_message"><?php echo $this->session->flashdata('message'); ?></span>
    <?php $this->load->element('grid_board');?>
  </div>
</form>
<script type='text/javascript'>
$(document).ready(function() {
  var menuItems = [{
      title: '<i class="fa fa-check-circle text-success"> Active</i>',
      value: 'Active'
    },
    {
      title: '<i class="fa fa-times-circle text-danger"> Inactive</i>',
      value: 'Inactive'
    }
  ];
  $("td.stat_menu a").statusMenu({
    items: menuItems
  });
});
</script>