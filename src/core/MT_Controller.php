<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -----------------------------------------------------
| PRODUCT NAME			: SMS
-----------------------------------------------------
| CONTROLLER CLASS NAME : MT_Controller
| -----------------------------------------------------
| AUTHOR				: Md.Meherul Islam
| -----------------------------------------------------
| EMAIL                 : meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT				: Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE				:			
| -----------------------------------------------------
*/
 
 class MT_Controller extends CI_Controller
 {
 	var $data=array();
 	var $name;
 	var $method;

 	function __construct()
 	{
 		parent::__construct();
		//$this->output->enable_profiler(TRUE);
 		$this->load->library('template','','tpl');
 		$this->load->helper(array('text','date'));
		$this->load->model(array('menumodel','admingroupmodel'));
 		$this->name=$this->router->class;
 		$this->method=$this->router->method;
 		$this->_check_access();
		$this->access_check();
		$this->_temp_init();
		$last = $this->uri->total_segments();
		$part_url_last = $this->uri->segment($last);		  		
 	}
	
 	function _temp_init()
 	{
 		$this->_assign_template_var();
		if($this->input->is_ajax_request())
		{
			$this->tpl->set_layout('ajax_layout');
		}
 	}

 	function _assign_template_var()
 	{
		$this->tpl->set_page_title('Admin panel');
		$this->tpl->assign('active_controller',$this->name);
		$this->tpl->assign('active_method',$this->method);
		$this->set_top_menu();		
 	}	
	
	function access_check()
	{
		$admin_group=$this->session->userdata('admin_group_id');
		$row = $this->menumodel->get_active_menu_id($this->full_url());
		if(!empty($row)){
			$row['admin_group_id'];	
		}else{
			$row['admin_group_id']=	$admin_group;
		}
		$admin_group_list=explode(',',$row['admin_group_id']);	
		if(in_array($admin_group,$admin_group_list))
		{
			return true;
		}elseif($this->name=='login' OR $this->name=='api'){
			return true;
		}elseif(empty($row) AND $_SERVER['HTTP_REFERER']!=''){
			return true;
		}
		else{
			redirect('home'); 
		}
	}	
	
	function set_top_menu()
 	{
		$class_li = '';
		$row = $this->menumodel->get_active_menu_id($this->full_url());
		if(empty($row)){
			$row['parent_id'] = 0;	
		}
		$admin_group=$this->session->userdata('admin_group_id');		
		$tm=$this->menumodel->get_menu_list('',$admin_group);
		$this->main_menu_data=$tm;
   	$this->_main_menu_html='<ul class="sidebar-menu">';
		$i=1;
		
		foreach($this->main_menu_data as $id=>$menu)
 		{	
			if ($id == $row['parent_id']) {
                $class_li = 'active';
            }elseif ($this->name == $menu['module_link'] AND $row['parent_id'] == 0) {
                $class_li = 'active';
            }else {
                $class_li = '';
            }
			if($menu['parent_id']==0)
			{			
				$found=$this->_check_main_menu_child($id);
				if($found>0){
					$subclass_li='treeview';
					$icon='<i class="fa fa-angle-right pull-right"></i>';
					$menu_link = '';
				}else{
					$subclass_li='';
					$icon='';
					$menu_link = 'menu_link';
				}				
				$this->_main_menu_html .="<li class='$class_li $subclass_li'><a class='".$menu_link."' href='".site_url().$menu['module_link']."'><i class='fa ".$menu['icon']." fa-lg' style='color:".$menu['icon_color'].";'></i><span class='menu_space'></span><span>".$menu['title']."</span>$icon</a>";
				unset($this->main_menu_data[$id]);
						
				$this->main_menu_data=array_filter($this->main_menu_data);				
				if($found>0){					
					$this->_make_child_main_menu($id);													
				}
			}
			$i++;
		}		
		$this->_main_menu_html .="</li>";
		$this->_main_menu_html .="</ul>";
		$html=$this->_main_menu_html;
		unset($this->_main_menu_html);
		unset($this->main_menu_data);
		$this->tpl->assign('top_menu_html',$html);	
 	}
	
	
	function _make_child_main_menu($pid)
	{
		
		$this->_main_menu_html .="<ul class='treeview-menu'>";
		foreach($this->main_menu_data as $id=>$menu){
			if($this->name.'/'.$this->method==$menu['module_link']){
				$class_li='active';
			}else{
				$class_li='';
			}	
			if($menu['parent_id']==$pid)
 			{ 				
 				$this->_main_menu_html .="<li class='$class_li'><a class='menu_link' href='".site_url().$menu['module_link']."'><i class='fa ".$menu['icon']."' style='color:".$menu['icon_color'].";'></i> ".$menu['title']."</a>";	
				unset($this->main_menu_data[$id]);
 				$this->main_menu_data=array_filter($this->main_menu_data);
				$found=$this->_check_main_menu_child($id);
				if($found>0)
				$this->_make_child_main_menu($id);
				$this->_main_menu_html .="</li>";
 			}			
		}
		$this->_main_menu_html .="</ul>";		
    }	
	
	function _check_main_menu_child($pid)
    {
		$found=0;
		foreach($this->main_menu_data as $id=>$menu1)
		{
			if($menu1['parent_id']==$pid)
			{
				$found++;
			}		
		}		 
		return $found;
    }	
	
 	function assign($key,$val='')
 	{
 		$this->tpl->assign($key,$val);
 	}

 	function set_layout($file)
 	{
 		$this->tpl->set_layout($file);
 	}

 	function set_pagination($info=array())
 	{
		$this->load->library('pagination');
 		$rec_per_page=$info['select_value'];
 		$data['offset']=0;

 		if($rec_per_page)
 		{
			$config['per_page'] = $rec_per_page;
 		}
 		else
 		{
			$config['per_page']=50;
 		}
 		$data['rec_per_page'] = $config['per_page'];
		$config['num_links'] = 2;
		$config['uri_segment'] = $info['uri_segment'];
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next →';
		$config['prev_link'] = '← Previous';
		$config['total_rows']=$info['total_rows'];
		$stypes=array('asc'=>'desc','desc'=>'asc');
		$nstype=$stypes[$info['sort_type']];
		$data['sort_type']=$info['sort_type'];
		$data['sort_on']=$info['sort_on'];

		if(!empty($info['sufix'])){
			$url=$this->tpl->site_url.$this->name.'/'.$this->method.'/'.$info['sufix'].'/';
		}
		else{
			$url=$this->tpl->site_url.$this->name.'/'.$this->method.'/';
		}
		
		if($info['sort_type'] && $info['sort_on'])

		{
			$config['base_url'] = $url.$info['sort_type'].'/'.$info['sort_on'].'/page';
			$data['sort_url'] = $url.$nstype.'/%s'.'/page';
		}
		else
		{
			$config['base_url'] =$url;
			$data['sort_url'] =$url.'asc/';
		}

		$this->pagination->initialize($config);
		$data['total_record'] = $config['total_rows'];
		$pagination_html= $this->pagination->create_links();
		$this->tpl->set_pagination($pagination_html);
		$this->db->order_by($info['sort_on'], $info['sort_type']);

		if($pagination_html)
		{

				$data['total_page'] = ceil($config['total_rows']/$config['per_page']);
				$data['cur_page']=$this->pagination->cur_page;
				$data['offset']=(int)$this->uri->segment($info['uri_segment']);
				$data['sort_url']=$data['sort_url'].'/'.$data['offset'];
				$this->db->limit($config['per_page'], $data['offset']);

		}
		else
		{
				$data['total_page'] = 1;
				$data['cur_page']=1;
				$data['offset']=0;

		}
		$this->tpl->assign($data);
 	}
	
	
 	function _check_access()
 	{
 		$username=$this->session->userdata('admin_username');
 		$userid=$this->session->userdata('admin_userid');
 		if($username && $userid)
 		{
 			$user=$this->loginmodel->get_logged_user();
 			if(empty($user))
 			{
 				redirect('login');	
 			}
 			elseif($this->name == 'login' && $this->method !='logout')
 			{
				redirect('home');
 			}
 			else
 			{
 				$this->assign('userdata',$user);
 			}
 		}
 		elseif($this->name=='api')
		{
			return true;
		}
		else
		{
 			$ret=$this->_is_login_require();
 			if($ret)
 			{
				redirect('login');
			}
			elseif($this->method != 'index' && $this->method !='logout')
			{
				redirect('login');
			}
 		}
 	}

 	function _is_login_require()
 	{
 		if($this->name=='login')
 		{
 			return false;
 		}
 		else
 		{
 			return true;
 		}
 	}
		
	/*-------------- set current date -----------------*/
	function current_date()
	{
		$timezone = "Asia/Dhaka";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);	
		return date("Y-m-d h:i:s");
	}
	
	/*-------------- End -----------------*/
	
	
	function status_change($id,$val,$model,$change_status)
	{
		if(strtolower($val)=='publish')
		{
			$data = '<span class="label label-success">Publish</span>';
		}else if(strtolower($val)=='unpublish')
		{
			$data = '<span class="label label-danger">Unpublish</span>';
		}else if(strtolower($val)=='active')
		{
			$data = '<span class="label label-success">Active</span>';
		}else if(strtolower($val)=='inactive')
		{
			$data = '<span class="label label-danger">Inactive</span>';
		}else if(strtolower($val)=='live')
		{
			$data = '<span class="label label-success">Live</span>';
		}else if(strtolower($val)=='draft')
		{
			$data = '<span class="label label-danger">Draft</span>';
		}
		$present_user_id=$this->session->userdata('admin_userid');
		if($present_user_id == $id){
			$message = $this->tpl->set_message('error','You can not change this status!');
			$status =0;
		}else{
			$message = $this->tpl->set_message('status','Status has been changed successfully');
			$status =1;	
			$this->$model->$change_status($id,$val);
		} 
		$array = array('id'=>$id,'data'=>$data,'message'=>$message,'status'=>$status);
		return json_encode($array);
	}
	
	
	function full_url()
	{
		$ci=& get_instance();
		$return = $ci->uri->uri_string();		
		return $return;
	} 
	
	function upload_dir()
	{
		return './upload_images/';
	}

	function view_404(){
		$this->output->set_status_header('404'); 
		$this->load->view('err404');//loading in custom error view
	}

	public function upload_images($field_name, $image_name,$folder_name)
    {
        $upconfig['upload_path'] = $this->upload_dir() .$folder_name."/";
        $file_info = pathinfo($image_name);
        $upconfig['file_name'] = basename($image_name, '.' . $file_info['extension']);
        $upconfig['allowed_types'] = 'gif|jpg|png';
        $upconfig['max_size'] = '10000';
        //$upconfig['min_width'] = '1590';
        //$upconfig['min_height'] = '670';
        $upconfig['overwrite'] = false;
        $this->load->library('upload');
        $this->upload->initialize($upconfig);
        if (!$this->upload->do_upload($field_name)) {
            return false;
        } else {
            $updata = $this->upload->data();
            if ($updata) {
                return true;
            }
        }
    }
	
	
	
 }

