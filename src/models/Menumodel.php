<?php
/*
| -----------------------------------------------------
| PRODUCT NAME     :
-----------------------------------------------------
| MODEL CLASS NAME : Menumodel
| -----------------------------------------------------
| AUTHOR           :Md.Meherul Islam
| -----------------------------------------------------
| EMAIL            : meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT        : Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE          :
| -----------------------------------------------------
 */
class Menumodel extends MT_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_home_menulist($group_id = '')
    {
        $admin_group_id = (!empty($group_id) ? $group_id : $this->session->userdata('admin_group_id'));
        $this->db->select('id,title menu_title,module_link,icon,icon_color,order,status,admin_group_id');
        $this->db->from('menu');
        $this->db->where('status', 'PUBLISH');
        $this->db->where('parent_id', 0);
        if ($admin_group_id != 1) {
            $this->db->where("FIND_IN_SET('$admin_group_id',admin_group_id) !=", 0);
        }
        $this->db->order_by('order');
        return $this->get_assoc();
    }

    public function get_list($id = '')
    {
        $this->db->select('id,title menu_title,module_link,icon,icon_color,order,status,admin_group_id');
        $this->db->from('menu');
        if ($id) {
            $this->db->where('parent_id', $id);
        } else {
            $this->db->where('parent_id', 0);
        }
        $this->db->order_by('order');
        return $this->get_assoc();
    }

    public function get_all_menu()
    {
        $this->db->select('id,title menu_title,module_link,order,status,admin_group_id');
        $this->db->from('menu');
        $this->db->order_by('order');
        return $this->get_assoc();
    }

    public function add($data)
    {
        $this->db->insert('menu', $data);
        return $this->db->insert_id();
    }

    public function get_record($id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id', $id);
        return $this->get_row();
    }

    public function count_list($id = '')
    {
        $this->db->select("count(id) num");
        $this->db->from('menu');
        if ($id) {
            $this->db->where('parent_id', $id);
        } else {
            $this->db->where('parent_id', 0);
        }
        return $this->get_one();
    }
    public function count_child($id)
    {
        $this->db->select("count(id) num");
        $this->db->from('menu');
        $this->db->where('parent_id', $id);
        return $this->get_one();
    }

    public function update_menu($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('menu', $data);
    }

    public function update_menu_permission($data)
    {
        $this->db->update_batch('menu', $data, 'id');
    }

    public function del($id)
    {
        $this->db->delete('menu', array('id' => $id));
    }

    public function change_status($id, $val)
    {
        $this->db->where('id', $id);
        $this->db->update('menu', array('status' => strtoupper($val)));
    }

    public function get_menu_details($id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id', $id);
        return $this->get_row();
    }

    public function get_menu_list($id = '', $admin_group = '')
    {
        $this->db->select('*');
        $this->db->from('menu');
        if ($id) {
            $this->db->where('parent_id', $id);
            $this->db->where("FIND_IN_SET('$admin_group',admin_group_id) !=", 0);
        } else {
            //$this->db->where('parent_id',0);
            $this->db->where("FIND_IN_SET('$admin_group',admin_group_id) !=", 0);
        }
        $this->db->where('status', 'PUBLISH');
        $this->db->order_by('order');
        return $this->get_assoc();
    }

    public function get_active_menu_id($url)
    {
        $this->db->select('id,parent_id,admin_group_id');
        $this->db->from('menu');
        $this->db->where('module_link', $url);
        $this->db->order_by('order');
        return $this->get_row();
    }

}