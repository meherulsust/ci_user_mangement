<?php
/*
| -----------------------------------------------------
| PRODUCT NAME        :
-----------------------------------------------------
| MODEL CLASS NAME    : Optionmodel
| -----------------------------------------------------
| AUTHOR              : Md.Meherul Islam
| -----------------------------------------------------
| EMAIL               : meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT           : Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE             :
| -----------------------------------------------------
 */
class Optionmodel extends MT_Model
{

    public function religion_options()
    {
        $this->db->select('id,title');
        $this->db->from('religion');
        //$this->db->where('status=','Active');
        $this->db->order_by('id', 'asc');
        return $this->get_assoc();
    }
    public function blood_group_options()
    {
        $this->db->select('id,symbol as title');
        $this->db->from('blood_group');
        //$this->db->where('status=','Active');
        $this->db->order_by('id', 'asc');
        return $this->get_assoc();
    }

}