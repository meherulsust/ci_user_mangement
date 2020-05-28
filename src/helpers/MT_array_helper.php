<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
 * Created on Jun 11, 2009
 *
 * Helper for extending ci array helper
 * 
 */
 
 function assoc($rows=array())
 {
 	foreach($rows as $row)
 	{
		$temp=each($row);
		$num=count($row);
		if($num==1)
		{
			$data[$temp['value']]=$temp['value'];
		}
		elseif($num==2)
			$data[$temp['value']]=array_pop($row);
		else
		$data[$temp['value']]=$row;
 	}
 	return $data; 	
 }
 
 function make_option($array)
 {
 	$data=array();
 	foreach( $array as $key=>$val)
 	{
 		$data[$val]=$val;
 	}
 	return $data;
 }
 
 function make_tree($menu_data){

  foreach($menu_data as $key=>$val){
      if($val['parent_id']==0){
      $menu[$val['id']]=array('title'=>ucwords($val['title']),'tips'=>$val['tips'],'status'=>$val['status']);
      	unset($menu_data[$key]);
        if($val['child_id']!=0){
       //find_child(&$menu_data,&$menu,$val['id']); // Desalbe for BAT testing server problem // 27-09-2012
        }
      }
  }

return $menu;

}
 
 function find_child($menu_data,$menu,$pid){
    foreach($menu_data as $key=>$val){
        if($val && $val['parent_id']==$pid){
        $menu[$pid]['child'][$val['id']]=array('title'=>ucwords($val['title']),'tips'=>$val['tips'],'status'=>$val['status']);
        $menu_data[$key]='';
        //$menu_data=array_filter($menu_data); 

          if($val['child_id']!=0){

         //find_child(&$menu_data,&$menu[$pid]['child'],$val['id']); // Desalbe for BAT testing server problem // 27-09-2012

        }

        }
    }
return true;

}

// make a cycle within  input array
function cycle($ary=array())
{
  static $pointer=0;
  if($pointer==count($ary))
  $pointer=0;
  return $ary[$pointer++]; 
  
}


function menu_sort($array)
{
	
	 uasort($array,'comp_callback');
	 
	return $array;
}

function comp_callback($a,$b)
{
	if ($a['order'] == $b['order']) {
        return 0;
    }
    return ($a['order'] < $b['order']) ? -1 : 1;
	
}




 
?>
