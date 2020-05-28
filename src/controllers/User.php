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
class User extends MT_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('usermodel', 'admingroupmodel'));
        $this->tpl->set_page_title('User Management');
    }

    public function index($sort_type = 'desc', $sort_on = 'id')
    {
        $this->tpl->set_js(array('jquery.statusmenu'));
        $labels = array('username' => 'Username', 'full_name' => 'Full Name', 'email' => 'Email', 'admin_type' => 'Admin Type', 'status' => 'Status');
        $this->assign('labels', $labels);
        $config['total_rows'] = $this->usermodel->count_list();
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
        $users = $this->usermodel->get_list();
        $this->assign('records', $users);
        $this->load->view('user/user_list');
    }

    public function view($id = '')
    {
        $id = decode($id);
        if ($id == '') {
            redirect('user');
        }
        $user = $this->usermodel->get_admin_details($id); // get record
        if ($user) {
            $this->tpl->set_css(array('datepicker/datepicker'));
            $this->tpl->set_js(array('plugins/datepicker/bootstrap-datepicker'));
            $this->tpl->set_page_title("View User information");
            $designation_options = ['Software Engineer' => 'Software Engineer', 'Software Devopoler' => 'Software Devopoler'];
            $this->assign('designation_options', $designation_options);
            $job_status_options = ['Confirmed' => 'Confirmed', 'Contructual' => 'Contructual'];
            $this->assign('job_status_options', $job_status_options);
            $this->assign($user);
            $this->load->view('user/view_user');
        } else {
            $this->view_404();
        }
    }

    public function add()
    {
        $this->tpl->set_page_title("Add new user");
        $this->load->library(array('form_validation'));
        $config = array(array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|min_length[5]|max_length[20]|callback_duplicate_user_check'),
            array('field' => 'passwd', 'label' => 'Password', 'rules' => 'trim|required|matches[confirm_password]|min_length[6]|alpha_numeric|callback_password_check'),
            array('field' => 'confirm_password', 'label' => 'Confirmation', 'rules' => 'trim|required'),
            array('field' => 'id_admin_group', 'label' => 'Admin Group', 'rules' => 'trim|required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|callback_duplicate_email_check'),
            array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
            array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim'),
            array('field' => 'address', 'label' => 'Address', 'rules' => 'trim'),
            array('field' => 'mobile', 'label' => 'Mobile number', 'rules' => 'trim|required'));
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<span class="verr"><i class="fa fa-exclamation-circle"></i> ', '</span>');
        $admin_group_options = $this->admingroupmodel->group_option(); // get admin group list
        $this->assign('admin_group_options', $admin_group_options);
        if ($this->form_validation->run() == false) {
            $this->load->view('user/new_user');
        } else {
            $data['username'] = $this->input->post('username');
            $data['passwd'] = md5($this->input->post('passwd'));
            $data['firstname'] = $this->input->post('firstname');
            $data['lastname'] = $this->input->post('lastname');
            $data['email'] = $this->input->post('email');
            $data['mobile'] = $this->input->post('mobile');
            $data['address'] = $this->input->post('address');
            $data['id_admin_group'] = $this->input->post('id_admin_group');
            if (trim($_FILES["image_file"]["name"]) != '') {
                $ext = explode(".", $_FILES['image_file']['name']);
                $file_ext = end($ext);
                $file_name = rand(100000, 999999) . '_' . rand(100000, 999999) . '.' . $file_ext;
                if ($this->upload_images('image_file', $file_name,'user_image')) {

                    $data['image'] = $file_name;
                    $user_id = $this->usermodel->add($data);
                    $this->session->set_flashdata('message', $this->tpl->set_message('add', 'User'));
                    redirect('user/index');

                } else {
                    $sdata['upload_error'] = $this->upload->display_errors();
                    $this->load->view('user/new_user', $sdata);
                }
            } else {
                $user_id = $this->usermodel->add($data);
                $this->session->set_flashdata('message', $this->tpl->set_message('add', 'User'));
                redirect('user/index');
            }
        }
    }
    public function edit($id = '')
    {
        $id = decode($id);
        $user = $this->usermodel->get_record($id); // get record
        if (!empty($user)) {
            $this->tpl->set_page_title("Edit user information");
            $this->load->library(array('form_validation'));
            $this->assign($user);
            $config1 = array(array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|min_length[5]|max_length[20]|callback_duplicate_user_check[' . $user['username'] . ']'),
                array('field' => 'id_admin_group', 'label' => 'Admin Group', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|callback_duplicate_email_check[' . $user['email'] . ']'),
                array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
                array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim'),
                array('field' => 'address', 'label' => 'Address', 'rules' => 'trim'),
                array('field' => 'mobile', 'label' => 'Mobile number', 'rules' => 'trim|required'));
            $config2 = array(array('field' => 'passwd', 'label' => 'Password', 'rules' => 'trim|matches[confirm_password]|min_length[6]|alpha_numeric|callback_password_check'),
                array('field' => 'confirm_password', 'label' => 'Confirmation', 'rules' => 'trim|required'));
            if (!empty($this->input->post('passwd'))) {
                $config = array_merge($config1, $config2);
                $this->form_validation->set_rules($config);
                $this->form_validation->set_error_delimiters('<span class="verr"><i class="fa fa-exclamation-circle"></i> ', '</span>');
                $this->form_validation->set_message('matches', 'Confirm password did not match with password');
            } else {
                $this->form_validation->set_rules($config1);
                $this->form_validation->set_error_delimiters('<span class="verr"><i class="fa fa-exclamation-circle"></i> ', '</span>');
            }
            $admin_group_options = $this->admingroupmodel->group_option(); // get admin group list
            $this->assign('admin_group_options', $admin_group_options);

            if ($this->form_validation->run() == false) {
                $this->load->view('user/edit_user');
            } else {
                $data['username'] = $this->input->post('username');
                $data['firstname'] = $this->input->post('firstname');
                $data['lastname'] = $this->input->post('lastname');
                $data['email'] = $this->input->post('email');
                $data['mobile'] = $this->input->post('mobile');
                $data['address'] = $this->input->post('address');
                $data['id_admin_group'] = $this->input->post('id_admin_group');
                if (!empty($this->input->post('passwd'))) {
                    $data['passwd'] = md5($this->input->post('passwd'));
                }
                if (trim($_FILES["image_file"]["name"]) != '') {
                    $ext = explode(".", $_FILES['image_file']['name']);
                    $file_ext = end($ext);
                    $file_name = rand(100000, 999999) . '_' . rand(100000, 999999) . '.' . $file_ext;
                    if ($this->upload_images('image_file', $file_name,'user_image')) {

                        $data['image'] = $file_name;
                        $this->usermodel->edit($id, $data); // Update data
                        if ($user['image'] != '') {
                            unlink($this->upload_dir() . "user_image/" . $user['image']);
                        }
                        $this->session->set_flashdata('message', $this->tpl->set_message('edit', 'User'));
                        redirect('user/index');

                    } else {
                        $sdata['upload_error'] = $this->upload->display_errors();
                        $this->load->view('user/edit_user', $sdata);
                    }
                } else {
                    $this->usermodel->edit($id, $data); // Update data
                    $this->session->set_flashdata('message', $this->tpl->set_message('edit', 'User'));
                    redirect('user/index');
                }
            }
        } else {
            $this->view_404();
        }
    }

    public function set_status($id, $val)
    {
        echo $this->status_change($id, $val, 'usermodel', 'change_status'); //model name 'usermdoel' method name 'change_status'
    }

    public function del($id = '')
    {
        $id = decode($id);
        $present_user_id = $this->session->userdata('admin_userid');
        $user = $this->usermodel->get_record($id);
        if ($present_user_id == $id) {
            $status = 0;
            $message = $this->tpl->set_message('error', 'You can not delete yourself!.');
        } else {
            $this->usermodel->del($id);
            $status = 1;
            if (isset($user['image']) and $user['image'] != "") {
                unlink($this->upload_dir() . "user_image/" . $user['image']);
            }
            $message = $this->tpl->set_message('delete', 'User');
        }
        $array = array('status' => $status, 'message' => $message);
        echo json_encode($array);
    }

    // Check password for alpha numeric

    public function password_check($str, $param = '')
    {
        if (!empty($str)) {
            if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
                return true;
            } else {
                $this->form_validation->set_message('password_check', 'Password must contain at least uppercase,lowercase and number characters');
                return false;
            }
        }
    }

    //check duplicate email for validation

    public function duplicate_email_check($str, $param = '')
    {
        $query = $this->db->query("SELECT id FROM admin where email='$str' AND email<>'$param'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('duplicate_email_check', "%s <span style='color:green;'>$str</span> already exists");
            return false;
        }
        return true;
    }

    // validation function for checking username duplicacy

    public function duplicate_user_check($str, $param = '')
    {
        $query = $this->db->query("SELECT id FROM admin where username='$str' AND username<>'$param'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('duplicate_user_check', "%s <span style='color:green;'>$str</span> already exists");
            return false;
        }
        return true;

    }


}