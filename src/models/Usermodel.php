<?php
/*
| -----------------------------------------------------
| PRODUCT NAME        :
-----------------------------------------------------
| MODEL CLASS NAME    : Usermodel
| -----------------------------------------------------
| AUTHOR              : Md.Meherul Islam
| -----------------------------------------------------
| EMAIL               : meherulsust@gmail.com
| -----------------------------------------------------
| WEBSITE             :
| -----------------------------------------------------
 */
class Usermodel extends MT_Model
{
    public function __construct()
    {
        parent::__construct();

        //$this->table='admin';
    }

    public function get_list()
    {
        $this->db->select('admin.id,username, CONCAT(firstname," ",lastname) as full_name,email, ag.title admin_type,admin.status', false);
        $this->db->from('admin');
        $this->db->join('admin_group ag', 'ag.id = id_admin_group', 'left');
        $this->db->where('admin.id_admin_group !=', 1);
        $rs = $this->db->get();
        $users = $rs->result_array();
        return $users;
    }

    public function count_list()
    {
        $this->db->select('admin.id');
        $this->db->from('admin');
        $this->db->join('admin_group ag', 'ag.id = id_admin_group', 'left');
        $this->db->where('admin.id_admin_group !=', 1);
        $rs = $this->db->get();
        $users = $rs->num_rows();
        return $users;
    }

    public function add($data)
    {
        $this->db->insert('admin', $data);
        return $this->db->insert_id();
    }

    public function edit($id = '', $data)
    {
        return $this->db->update('admin', $data, array('id' => $id));
    }

    public function edit_password($id)
    {
        $timezone = "Asia/Dhaka";
        if (function_exists('date_default_timezone_set')) {
            date_default_timezone_set($timezone);
        }

        $data['passwd'] = $this->input->post('new_passwd');
        return $this->db->update('admin', $data, array('id' => $id));
    }

    public function get_admin_details($id)
    {
        $this->db->select('ad.username,email,mobile,image,address,ad.status,CONCAT(ad.firstname," ",ad.lastname) as full_name,ag.title admin_type', false);
        $this->db->from('admin ad');
        $this->db->join('admin_group ag', 'ag.id = ad.id_admin_group', 'left');
        $this->db->where('ad.id', $id);
        return $this->get_row();
    }

    public function get_record($id)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id', $id);
        return $this->get_row();
    }

    public function change_status($id, $val)
    {
        $this->db->where('id', $id);
        $this->db->update('admin', array('status' => strtoupper($val)));
    }

    public function del($id)
    {
        $this->db->delete('admin', array('id' => $id));
    }

    public function user_option()
    {
        $this->db->select('id,username title');
        $this->db->from('admin');
        $this->db->where('id_admin_group >', 2);
        $this->db->order_by('username', 'asc');
        return $this->get_assoc();
    }

}