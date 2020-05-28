<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
| -----------------------------------------------------
| PRODUCT NAME          :
-----------------------------------------------------
| CONTROLLER CLASS NAME : User
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
class Admingroup extends MT_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('admingroupmodel'));
        $this->tpl->set_page_title('User Management');
    }

    public function index($sort_type = 'desc', $sort_on = 'id')
    {
        $this->tpl->set_js(array('jquery.statusmenu'));
        $labels = array('title' => 'Admin Group Name', 'comment' => 'Description', 'status' => 'Status');
        $this->assign('labels', $labels);
        $config['total_rows'] = $this->admingroupmodel->count_admingroup();
        $config['uri_segment'] = 6;
        $config['select_value'] = $this->input->post('rec_per_page');
        $config['sort_on'] = $sort_on;
        $config['sort_type'] = $sort_type;
        if ($this->session->userdata('admin_userid') == 1) {
            $this->assign('grid_action', array('edit' => 'edit', 'del' => 'del'));
        } else {
            $this->assign('grid_action', array('edit' => 'edit'));
        }
        $this->set_pagination($config);
        $list = $this->admingroupmodel->get_admingroup(); // get data list
        $this->assign('records', $list);
        $this->load->view('admingroup/list');
    }

    public function add()
    {
        $page['page_title'] = "New Admin Group";
        $this->tpl->set_page_title("New Admin Group");
        $this->load->library(array('form_validation'));
        $config = array(array('field' => 'title', 'label' => 'Admin Group Name', 'rules' => 'trim|required'),
            array('field' => 'comment', 'label' => 'Description', 'rules' => 'trim'),
            array('field' => 'status', 'label' => 'Status', 'rules' => 'trim'));
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<span class="verr">', '</span>');
        if ($this->form_validation->run() == false) {
            $status_option = array('Active' => 'Active', 'Inactive' => 'Inactive');
            $this->assign('status_option', $status_option);
            $this->load->view('admingroup/new');
        } else {

            $data['title'] = $this->input->post('title');
            $data['comment'] = $this->input->post('comment');
            $data['status'] = $this->input->post('status');
            $admingroup_id = $this->admingroupmodel->add($data);
            if ($admingroup_id) {
                $this->session->set_flashdata('message', $this->tpl->set_message('add', 'Admin Group'));
                redirect('admingroup/index');
            }
        }
    }

    public function edit($id = '')
    {
        $id = decode($id);
        $row = $this->admingroupmodel->get_admingroup_record($id);
        if (!empty($row)) {
            $this->assign($row);
            $this->load->library(array('form_validation'));
            $config = array(array('field' => 'title', 'label' => 'Admin Group Name', 'rules' => 'trim|required'),
                array('field' => 'comment', 'label' => 'Description', 'rules' => 'trim'),
                array('field' => 'status', 'label' => 'Status', 'rules' => 'trim'));

            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<span class="verr">', '</span>');
            if ($this->form_validation->run() == false) {
                $status_option = array('Active' => 'Active', 'Inactive' => 'Inactive');
                $this->assign('status_option', $status_option);
                $this->load->view('admingroup/edit');
            } else {

                $data['title'] = $this->input->post('title');
                $data['comment'] = $this->input->post('comment');
                $data['status'] = $this->input->post('status');
                $this->admingroupmodel->edit($id, $data);
                $this->session->set_flashdata('message', $this->tpl->set_message('edit', 'Admin Group'));
                redirect('admingroup/index');

            }
        } else {
            $this->view_404();
        }

    }

    public function del($id = '')
    {
        $id = decode($id);
        $admingroup = $this->admingroupmodel->count_admingroup_user($id);
        if ($admingroup > 0) {
            $status = 0;
            $message = $this->tpl->set_message('error', 'Please delete this admin group user first.');
        } else {
            $this->admingroupmodel->del($id);
            $status = 1;
            $message = $this->tpl->set_message('delete', 'Admin Group');
        }
        $array = array('status' => $status, 'message' => $message);
        echo json_encode($array);
    }

    public function set_status($id, $val)
    {
        echo $this->status_change($id, $val, 'admingroupmodel', 'change_status'); //model name 'admingroupmodel' method name 'adm_change_status'
    }
}