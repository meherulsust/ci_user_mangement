<?php
/*
 * Created on Mar 11, 2010
 *
 * Created By Reza Ahmed
 */
 
 class Tree
 {
 	var $_tree_data;
 	var $_tree=array();
 	var $_parent_field;
 	var $_child_field;
 	
 	function __construct()
 	{
 		$this->_parent_field='parent_id';
 		$this->_child_field= 'child_id';
 	}
 	
 	function build($data)
 	{
 	  $this->_tree_data=$data;
 	  unset($data);
 	  foreach($this->_tree_data as $key=>$val)
 	  {
      	if($val[$this->_parent_field]==0)
      	{
      		$this->_tree[$val['id']]=array('title'=>ucwords($val['title']),'tips'=>$val['tips'],'status'=>$val['status']);
      		unset($this->_tree_data[$key]);
       		 if($val[$this->_child_field]!=0)
       		 {
       		 	
        		$this->_tree_data[$val['id']]['child']=$this->_get_branch($val['id'],$this->_tree[$val['id']]);
        	 }
         }
  	  }

	  return $this->_tree;	
   }
   
   
   function _get_branch($pid,$parent)
   {
	   	foreach($this->_tree_data as $key=>$val)
	   	{
	        if($val && $val[$this->_parent_field]==$pid)
	        {
	       		$parent[$val['id']]=array('title'=>ucwords($val['title']),'tips'=>$val['tips'],'status'=>$val['status']);
	        	unset($this->_tree_data[$key]);
	          	if($val[$this->_child_field]!=0)
	          	{
	         		$parent=$this->_get_branch($val['id'],$parent);
				}
				
	
	        }
	    }
	    return $parent;
   }
 }
?>
