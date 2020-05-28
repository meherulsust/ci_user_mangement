<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
| -----------------------------------------------------
| PRODUCT NAME          :
|-----------------------------------------------------
| CONTROLLER CLASS NAME : Menu
| -----------------------------------------------------
| AUTHOR                : Md.Meherul Islam
| -----------------------------------------------------
| EMAIL                 : meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT             : Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE               :
| -----------------------------------------------------
 */
class Menu extends MT_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('menumodel', 'admingroupmodel'));
        $this->tpl->set_page_title('Menu manager');
    }
    public function index($sort_type = 'desc', $sort_on = 'id')
    {
        $data['page_title'] = 'Menu List';
        $data['link_title'] = 'New Menu';
        $data['link_action'] = 'menu/add';
        $labels = array('menu_title' => 'Title', 'module_link' => 'Module Link', 'order' => 'Order', 'status' => 'Status');
        $this->tpl->set_js(array('jquery.statusmenu'));
        $this->assign('labels', $labels);
        $config['total_rows'] = $this->menumodel->count_list();
        $config['uri_segment'] = 6;
        $config['select_value'] = $this->input->post('rec_per_page');
        $config['sort_on'] = $sort_on;
        $config['sort_type'] = $sort_type;
        if ($this->session->userdata('admin_userid') == 1) {
            $this->assign('grid_action', array('view' => 'view', 'edit' => 'edit', 'del' => 'del'));
        } else {
            $this->assign('grid_action', array('view' => 'view', 'edit' => 'edit'));
        }
        $this->set_pagination($config);
        $menu = $this->menumodel->get_list();
        $this->assign('records', $menu);
        $this->load->view('menu/menu_list', $data);
    }
    /**
     * @param string $parent_id
     */
    public function add($parent_id = '')
    {
        $parent_id = decode($parent_id);
        $this->load->library('form_validation');
        $config = array(array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
            array('field' => 'module_link', 'label' => 'module_link', 'rules' => 'trim|required'),
            array('field' => 'order', 'label' => 'Order', 'rules' => 'trim|required|numeric'),
            array('field' => 'status', 'label' > 'Status', 'rules' => 'trim|required'),
            array('field' => 'icon', 'label' => 'Icon', 'rules' => 'trim'),
            array('field' => 'icon_color', 'label' => 'Icon Color', 'rules' => 'trim'),
            array('field' => 'admin_group_id[]', 'label' => 'Admin Group Permission', 'rules' => 'trim|required'));
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<span class="verr"><i class="fa fa-exclamation-circle"></i> ', '</span>');
        if ($this->form_validation->run() == true) {
            $data['title'] = $this->input->post('title');
            if ($parent_id) {
                $data['parent_id'] = $parent_id;
            }
            $data['admin_group_id'] = implode(',', $this->input->post('admin_group_id'));
            $data['module_link'] = $this->input->post('module_link');
            $data['order'] = $this->input->post('order');
            $data['status'] = $this->input->post('status');
            $data['icon'] = $this->input->post('icon');
            $data['icon_color'] = $this->input->post('icon_color');
            $menu_id = $this->menumodel->add($data);
            if ($menu_id) {
                $this->session->set_flashdata('message', $this->tpl->set_message('add', 'Menu'));
                if ($parent_id) {
                    redirect('menu/view/' . encode($parent_id));
                } else {
                    redirect('menu');
                }
            }
        } else {
            $admin_group_options = $this->admingroupmodel->group_option(); // get admin group list
            $this->assign('admin_group_options', $admin_group_options);
            $status_option = array('PUBLISH' => 'Publish', 'UNPUBLISH' => 'Unpublish');
            $this->assign('status_option', $status_option);
            $this->assign('parent_id', $parent_id);
            $this->load->view('menu/new_menu');
        }
    }

    public function edit($id = '', $parent_id = '')
    {
        $id = decode($id);
        $parent_id = decode($parent_id);
        $row = $this->menumodel->get_record($id);
        if (!empty($row)) {
            $this->assign($row);
            $this->load->library(array('form_validation'));
            $config = array(array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                array('field' => 'module_link', 'label' => 'module_link', 'rules' => 'trim|required'),
                array('field' => 'order', 'label' => 'Order', 'rules' => 'trim|required|numeric'),
                array('field' => 'status', 'label' => 'Status', 'rules' => 'trim|required'),
                array('field' => 'icon', 'label' => 'Icon', 'rules' => 'trim'),
                array('field' => 'icon_color', 'label' => 'Icon Color', 'rules' => 'trim'),
                array('field' => 'admin_group_id[]', 'label' => 'Admin Group Permission', 'rules' => 'trim|required'));
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<span class="verr"><i class="fa fa-exclamation-circle"></i> ', '</span>');

            if ($this->form_validation->run() == true) {
                $new_data['title'] = $this->input->post('title');
                $new_data['admin_group_id'] = implode(',', $this->input->post('admin_group_id'));
                $new_data['order'] = $this->input->post('order');
                $new_data['status'] = $this->input->post('status');
                $new_data['module_link'] = $this->input->post('module_link');
                $new_data['icon'] = $this->input->post('icon');
                $new_data['icon_color'] = $this->input->post('icon_color');
                $this->menumodel->update_menu($id, $new_data);
                $this->session->set_flashdata('message', $this->tpl->set_message('edit', 'Menu'));
                if ($parent_id) {
                    redirect('menu/view/' . encode($parent_id));
                } else {
                    redirect('menu');
                }
            } else {
                $admin_group_options = $this->admingroupmodel->group_option(); // get admin group list
                $admin_group = explode(',', $row['admin_group_id']); // explode task array
                $status_option = array('PUBLISH' => 'Publish', 'UNPUBLISH' => 'Unpublish');
                $this->assign('admin_group_options', $admin_group_options);
                $this->assign('admin_group', $admin_group);
                $this->assign('status_option', $status_option);
                $this->assign('parent_id', $parent_id);
                $this->load->view('menu/edit_menu');
            }
        } else {
            $this->view_404();
        }
    }

    public function del($id = '', $parent_id = '')
    {
        $id = decode($id);
        $parent_id = decode($parent_id);
        $child = $this->menumodel->count_child($id);
        if ($child > 0) {
            $status = 0;
            $message = $this->tpl->set_message('error', 'Please delete child first.');
        } elseif ($id == 1) {
            $status = 0;
            $message = $this->tpl->set_message('error', 'You can not delete home menu');
        } else {
            $this->menumodel->del($id);
            $status = 1;
            $message = $this->tpl->set_message('delete', 'Menu');
        }
        $array = array('status' => $status, 'message' => $message);
        echo json_encode($array);
    }

    public function set_status($id, $val)
    {
        echo $this->status_change($id, $val, 'menumodel', 'change_status'); //model name 'menumodel' method name 'change_status'
    }

    public function view($id = '')
    {
        $id = decode($id);
        if ($id == '') {
            redirect('menu');
        }
        $this->tpl->set_page_title("View menu information");
        $menu = $this->menumodel->get_menu_details($id); // get record
        $this->assign($menu);
        $admin_group_options = $this->admingroupmodel->group_option(); // get admin group list
        $this->assign('admin_group_options', $admin_group_options);
        $admin_group = explode(',', $menu['admin_group_id']); // explode task array
        $this->assign('admin_group', $admin_group);

        //------------ for grid board ---------------//
        $labels = array('menu_title' => 'Title', 'module_link' => 'Module Link', 'order' => 'Order', 'status' => 'Status');
        $this->tpl->set_js(array('jquery.statusmenu'));
        $this->assign('labels', $labels);
        $config['total_rows'] = $this->menumodel->count_list($id);
        $config['uri_segment'] = 6;
        $config['select_value'] = $this->input->post('rec_per_page');
        $config['sort_on'] = 'id';
        $config['sort_type'] = 'desc';
        if ($this->session->userdata('admin_userid') == 1) {
            $this->assign('grid_action', array('edit' => 'edit', 'del' => 'del'));
        } else {
            $this->assign('grid_action', array('edit' => 'edit'));
        }
        $this->set_pagination($config);
        $menu = $this->menumodel->get_list($id);
        $this->assign('records', $menu);

        $this->load->view('menu/view_menu');
    }

}