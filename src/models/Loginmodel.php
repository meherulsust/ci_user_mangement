<?php
/*
| -----------------------------------------------------
| PRODUCT NAME         :
-----------------------------------------------------
| CONTROLLER CLASS NAME: Loginmodel
| -----------------------------------------------------
| AUTHOR               : Md.Meherul Islam
| -----------------------------------------------------
| EMAIL                : meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT            : Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE:
| -----------------------------------------------------
 */
class Loginmodel extends MT_Model
{
    public $table = 'admin';

    public function check_login()
    {
        $user = $this->input->post('username');
        $pass = md5($this->input->post('passwd'));
        $this->db->where(array('username' => $user, 'passwd' => $pass, 'status' => 'ACTIVE'));
        $row = $this->get_row();
        if ($this->db->affected_rows() == 1) {
            $row = $row;
        }

        if ($this->db->affected_rows() > 1) {
            $row = array();
        }

        return $row;
    }

    public function get_logged_user()
    {
        $userid = $this->session->userdata('admin_userid');
        $username = $this->session->userdata('admin_username');
        $admin_group_id = $this->session->userdata('admin_group_id');
        $this->db->select('admin.id,id_admin_group, username, firstname,ag.title admin_type,lastname,' .
            ' email, address, mobile,admin.status');
        $this->db->join('admin_group ag', 'ag.id = id_admin_group', 'left');
        $this->db->where(array('admin.id' => $userid, 'username' => $username));
        $user = $this->get_row();
        return $user;
    }

    public function update_login_time($user_id, $date_time)
    {
        $data['last_login_time'] = $date_time;
        $this->db->update('admin', $data, array('id' => $user_id));
    }

}