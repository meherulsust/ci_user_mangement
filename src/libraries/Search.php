<?php
/*
 * Created on Jan 21, 2015
 *
 * Created By Imrul Hasan
 */
 
 class Search{
 
 	function data_search($data)
	{
		$CI =& get_instance();
		
		if(count(array_filter($data))>0){
			foreach($data as $key=>$val)
			{
				$sdata[$key] = $val;
			}
			$CI->session->set_userdata($sdata);
			$check=count(array_filter($sdata));
			$CI->session->set_userdata('check_array',$check);			
			
		}elseif($CI->session->userdata('check_array')>0 AND $CI->uri->segment(5)=='page'){
			foreach($data as $key=>$val)
			{
				$sdata[$key] = $CI->session->userdata($key);
			}	
		}else{
			foreach($data as $key=>$val)
			{
				$sdata[$key] = '';				
			}
			$CI->session->unset_userdata($sdata);			
		} 
		return $sdata;
	}
 }
?>
