<?php
/*
| -----------------------------------------------------
| PRODUCT NAME         :
-----------------------------------------------------
| MODEL CLASS NAME     : Admingroupmodel
| -----------------------------------------------------
| AUTHOR               : Md.Meherul Islam
| -----------------------------------------------------
| EMAIL                : meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT            : Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE              :
| -----------------------------------------------------
 */
class Admingroupmodel extends MT_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function group_option()
    {
        $this->db->select('id,title');
        $this->db->from('admin_group');
        if ($this->session->userdata('admin_group_id') != 1) {
            $this->db->where('id !=', 1);
        }
        $this->db->where('status', 'Active');
        $this->db->order_by('id', 'asc');
        return $this->get_assoc();
    }
    public function get_admingroup()
    {
        $this->db->select('id,title,comment,status');
        $this->db->from('admin_group');
        $rs = $this->db->get();
        return $rs->result_array();
    }

    public function count_admingroup()
    {
        $this->db->select("count(id) num");
        $this->db->from('admin_group');
        return $this->get_one();
    }

    public function add($data)
    {
        $this->db->insert('admin_group', $data);
        return $this->db->insert_id();
    }

    public function edit($id, $data)
    {
        $this->db->update('admin_group', $data, array('id' => $id));
    }

    public function get_admingroup_record($id = '')
    {
        $this->db->select('*');
        $this->db->from('admin_group');
        $this->db->where('id', $id);
        return $this->get_row();
    }

    public function del($id)
    {
        $this->db->delete('admin_group', array('id' => $id));
    }

    public function change_status($id, $val)
    {

        $this->db->where('id', $id);
        $this->db->update('admin_group', array('status' => strtoupper($val)));
    }
    public function count_admingroup_user($id)
    {
        $this->db->select("count(id) num");
        $this->db->from('admin');
        $this->db->where('id_admin_group', $id);
        return $this->get_one();
    }

}