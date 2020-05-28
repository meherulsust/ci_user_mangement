<?php
/*
| -----------------------------------------------------
| PRODUCT NAME      :
-----------------------------------------------------
| MODEL CLASS NAME  : Homemodel
| -----------------------------------------------------
| AUTHOR            : Md.Meherul Islam
| -----------------------------------------------------
| EMAIL             : meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT         :Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE           :
| -----------------------------------------------------
 */
class Homemodel extends MT_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // get total balance

    public function get_total_balance($user_id)
    {
        $this->db->select('balance');
        $this->db->from('topup_admin');
        $this->db->where('id', $user_id);
        return $this->get_row();
    }

}