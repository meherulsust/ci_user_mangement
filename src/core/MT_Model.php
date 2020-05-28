<?php
/*
| -----------------------------------------------------
| MODEL CLASS NAME: 	MTCMS
-----------------------------------------------------
| CONTROLLER CLASS NAME: MT_Model
| -----------------------------------------------------
| AUTHOR:			Md.Meherul Islam
| -----------------------------------------------------
| EMAIL:			meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT:		Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE:			
| -----------------------------------------------------
*/
 class MT_Model extends CI_Model
 {
 	var $table; //contain table name

 	function __construct()
 	{
 		parent::__construct();

 	}

	function f($flield,$id,$table='')
	{
		$table=empty($table)?$this->table:$table;
		$this->db->select($flield);
		$this->db->from($table);
		$this->db->where('id',$id);
	    $query=$this->db->get();
	    $row=$query->result_array();
	    if(count($row[0])==1)
	    return $row[0][$flield];
	    else
	    return $row[0];
	}

	function get_row($table='')
	{
		$table=empty($table)?$this->table:$table;
		$query=$this->db->get($table);
		$rows=$query->result_array();
		if($rows)
		{
			return array_pop($rows);
		}
		else
		{
			return array();
		}
	}

	function get_assoc($table='')
	{
		$data=array();
		$table=empty($table)?$this->table:$table;
		$query=$this->db->get($table);
		$rows=$query->result_array();
		if(is_array($rows))
		{
			foreach($rows as $row)
 			{
				$num=count($row);
				if($num==1)
				{
					$data[$row['id']]=$row['id'];
				}
				elseif($num==2)
				{
					$data[$row['id']]=array_pop($row);
				}
				else
				{
					$data[$row['id']]=$row;
				}
 			}
 			return $data;

		}
	}

	function get_one($table='')
	{
		$row=$this->get_row($table);
		return array_pop($row);
	}

	function curdate()
	{
		return date("Y-m-d h:i:s");
	}

	function del_row($id)
	{
			$this->db->delete($this->table,array('id'=>$id));

	}
	function option_list($fields=array(),$tbl='',$where='',$order_by='')
	{
			if(is_array($fields))
			{
				$this->db->select(implode(',',$fields));
			}
			else
			{
				$this->db->select('id,'.$fields);
			}
			if($where)
			{
				$this->db->where($where);
			}
            if($order_by!=""){
                $this->db->order_by($order_by);
            }
			return $this->get_assoc($tbl);
	}
	
 }

