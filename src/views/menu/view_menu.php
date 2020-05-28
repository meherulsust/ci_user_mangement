<div class="box box-primary">
  <div class="box-header">
    <i class="fa fa-list-alt"></i>
    <h3 class="box-title">Menu Details</h3>
  </div>
  <table class="form_table">
    <tr>
      <td>Title :</td>
      <td>
        <?php echo $title; ?>
      </td>
    </tr>
    <tr>
      <td>Admin Group Permission :</td>
      <td>
        <?php
if (!empty($admin_group_options)) {
    foreach ($admin_group_options as $val => $lb) {
        foreach ($admin_group as $cval => $clb) {
            if ($val == $clb) {
                echo $lb . ',';
            }
        }
    }
}
?>
      </td>
    </tr>
    <tr>
      <td>Order :</td>
      <td>
        <?php echo $order; ?>
      </td>
    </tr>

    <tr>
      <td>Status :</td>
      <td>
        <?php echo $status; ?>
      </td>
    </tr>
    <tr>
      <td>Module link :</td>
      <td>
        <?php echo $module_link; ?>
      </td>
    </tr>
  </table>
</div>
<div class="box box-primary">
  <div class="box-header">
    <i class="fa fa-table"></i>
    <h3 class="box-title">Submenu List</h3>
    <div class="box-tools pull-right">
      <a href="<?=$site_url;?>menu/add/<?=encode($id);?>">
        <button class="btn btn-primary btn-xs" type="button"><i class='fa fa-plus'></i> Add Submenu</button>
        <a href="<?=$site_url . $active_controller;?>"><span class="btn btn-primary btn-xs">Cancel</span></a>
      </a>
    </div>
  </div>
  <span class="delete_message"><?php echo $this->session->flashdata('message'); ?></span>
  <?php $this->load->element('grid_board');?>
</div>
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