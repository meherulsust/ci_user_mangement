<?php 

 function html_options($opts,$selected)
 {
 	$html="";
 	if(is_array($opts))
 	{
 	 $selected = is_array($selected)? $selected: array($selected); 	 
 	 foreach($opts as $key=>$val){
      if( in_array($key,$selected))
      $html .= "<option  selected value='$key'>$val</option>";
      else
      $html .= "<option  value='$key'>$val</option>";   
    }
 		return $html;
 	}
 	
 }
 
	function ajax_html_options($opts,$selected)
	{
		$html="";
		if(is_array($opts))
		{
			$selected = is_array($selected)? $selected: array($selected); 	 
			foreach($opts as $row)
 			{
		      if( in_array($row['id'],$selected))
		     	 $html .= '<option  selected value="'.$row['id'].'">'.$row['title'].'</option>';
		      else
		     	 $html .= '<option  value="'.$row['id'].'">'.$row['title'].'</option>';   
		    }
			return $html;
		} 	
	}			
 
 
 // created by Imrul 
 // created on 09-10-12
 
	function html_options_exp($opts,$selected)
	{
		$html="";
		if(is_array($opts))
		{
			 $selected = is_array($selected)? $selected: array($selected); 	 
			 foreach($opts as $val){
			  if( in_array($val['id'],$selected))
			  $html .= "<option  selected value=".$val['id'].">".$val['firstname']." ".$val['lastname']."</option>";
			  else
			  $html .= "<option  value=".$val['id'].">".$val['firstname']." ".$val['lastname']."</option>"; 
		}
			return $html;
		}

	}
 
 ///--------------- end ---------------//
 
	function html_options_menu_type($opts,$selected="")
	{
		$sel = isset($_POST['menu_type_id']) ? $_POST['menu_type_id'] : $selected;
		$html="";
		if(is_array($opts))
		{
		 //$selected = is_array($selected)? $selected: array($selected); 	 
		 foreach($opts as $key=>$val){
		  $selected = ($sel == $val['id'] ) ? 'selected' : '';
		  $html .= "<option  ".$selected." value='".$val['id']."'>".$val['title']."</option>";
			
		}
			return $html;
		} 	
	}
 
	function html_menu_options($menu_data,$sel=array())
	{
		$CI= &get_instance();
		$CI->temp_menu_data=$menu_data;
		$CI->temp_html_menu_option="";
		$sel = is_array($sel)? $sel: array($sel);
		foreach($CI->temp_menu_data as $id=>$menu)
		{
			if($menu['parent_id']==0)
			{
				if(in_array($id,$sel))
					$CI->temp_html_menu_option .="<option value='$id' selected class='op'>".$menu['title']."</option>";
				else
					$CI->temp_html_menu_option .="<option value='$id' class='op'>".$menu['title']."</option>";
			
					unset($CI->temp_menu_data[$id]);
					$CI->temp_menu_data=array_filter($CI->temp_menu_data);
					if($menu['is_child'])
				html_child_menu_options($id,0,$sel);
			}		
		}
		$html=$CI->temp_html_menu_option;
		unset($CI->temp_html_menu_option);
		unset($CI->temp_menu_data);
		return $html;
	}	
	
	function html_child_menu_options($pid,$depth,$sel){
		$depth++;
		$CI= &get_instance();
		$sel = is_array($sel)? $sel: array($sel);
		foreach($CI->temp_menu_data as $id=>$menu)
		{
			if($pid==$menu['parent_id'])
			{
				if(in_array($id,$sel))
				$CI->temp_html_menu_option .="<option class='oc' selected value='$id'>".str_repeat(" &#187",$depth)." ".$menu['title']."</option>";
				else
				$CI->temp_html_menu_option .="<option class='oc' value='$id'>".str_repeat(" &#187",$depth)." ".$menu['title']."</option>";
				unset($CI->temp_menu_data[$id]);
				$CI->temp_menu_data=array_filter($CI->temp_menu_data);
				if($menu['is_child'])
				html_child_menu_options($id,$depth,$sel);
			}	
		 }
 	}
	
	
	function checkbox_tree($menu_data,$sel=array())
	{
		$CI= &get_instance();
		$CI->temp_menu_tree_data=$menu_data;
		$CI->temp_tree_option="";
		foreach($CI->temp_menu_tree_data as $id=>$menu)
		{
			if($menu['parent_id']==0)
			{
				$CI->temp_tree_option .= html_checkbox($id,$menu['title'],$sel)."</br>";				
				unset($CI->temp_menu_tree_data[$id]);
				$CI->temp_menu_tree_data=array_filter($CI->temp_menu_tree_data);
				if($menu['is_child'])
				checkbox_tree_child($id,0,$sel);
			}		
		}
		$html=$CI->temp_tree_option;
		unset($CI->temp_tree_option);
		unset($CI->temp_menu_tree_data);
		return $html;
	}	
	
	function checkbox_tree_child($pid,$depth,$sel){
		$depth++;
		$CI= &get_instance();
		foreach($CI->temp_menu_tree_data as $id=>$menu)
		{
			if($pid==$menu['parent_id'])
			{
				$CI->temp_tree_option .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html_checkbox($id,$menu['title'],$sel)."</br>";
				unset($CI->temp_menu_tree_data[$id]);
				$CI->temp_menu_tree_data=array_filter($CI->temp_menu_tree_data);
				if($menu['is_child'])
				checkbox_tree_child($id,$depth,$sel);
			}	
		}
 	}
	
	function html_checkbox($id,$title,$array)
	{
	    $name = 'additional_parent_id[]';
		$value = explode(',',$array);	                        
		if(!empty($value)){
			$checked = (in_array($id,$value) && empty($_POST) ? 'checked' : '');
			$html .='<input type="checkbox" name="'.$name.'" value="'.$id.'" '.set_checkbox($name,$id).' '.$checked.'/> '.$title;
		}else{
			$html .='<input type="checkbox" name="'.$name.'" value="'.$id.'" '.set_checkbox($name,$id).'/> '.$title;
		}	            
	           
	    return $html;
	}
 	
 	function menu_leftmenu($cat_tree)
 	{
 		
 		$CI= &get_instance();
 		$CI->temp_html_menu_option="<ul>";
 		$url=site_url();
 		foreach($cat_tree as $pid=>$menu)
 		{
 			if(is_array($menu['child']))
 			{
				$CI->temp_html_menu_option .="<li class='parent'><a href='$url/search/cat_search/null/$pid'>".$menu['title']."</a><ul>";
				child_menu_leftmenu($menu['child'],0);
				$CI->temp_html_menu_option .="</li></ul>";
 			}	
			else
			$CI->temp_html_menu_option .="<li class='child'><a href='$url/search/cat_search/null/$pid'>".$menu['title']."</a></li>";
		}
		$html=$CI->temp_html_menu_option.'</ul>';
		unset($CI->temp_html_menu_option);
		return $html;
 		
 	}
 	
	function child_menu_leftmenu($menu_data,$depth){
		$depth++;
		$CI= &get_instance();
		$url=site_url();
		foreach($menu_data as $pid=>$menu){
			if(is_array($menu['child']))
 			{
				$CI->temp_html_menu_option .="<li class='parent'><a href='$url/search/cat_search/null/$pid'>".$menu['title']."</a><ul>";
				child_menu_leftmenu($menu['child'],0);
				$CI->temp_html_menu_option .="</ul></li>";
 			}	
			else
			$CI->temp_html_menu_option .="<li class='child'><a href='$url/search/cat_search/null/$pid'>".$menu['title']."</a></li>";
		}
 	}
 	
 	function show_ad($cat_id)
 	{
 		 $CI= &get_instance();
 		 $CI->load->model('Admodel');
 		 $cat_id=empty($cat_id)?1:$cat_id;
 		 $ads=$CI->Admodel->get_ad_by_cat($cat_id);
 		 foreach($ads as $ad)
 		 {
 		 	$img_url=base_url().'/uploads/ad_images/'.$ad['file_name'];
 		 	$html .="<a href='http://".$ad['url']."' ><img src='$img_url' alt='".$ad['title']."'/></a> ";
 		 }
 		 
 		 echo $html;
 	} 	
 	
 	function printr($var)
 	{
 		echo "<pre>";
 		print_r($var);
 		echo "</pre>";
 		
	 }
	 
	 if(!function_exists('encode')){
		 function encode($var){
				return base64_encode($var);
		 }
	 }

	 if(!function_exists('decode')){
		 function decode($var){	
				return base64_decode($var);
		 }
	 }
