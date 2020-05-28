<?php
/*
| -----------------------------------------------------
| PRODUCT NAME          :
-----------------------------------------------------
| CONTROLLER CLASS NAME : Home
| -----------------------------------------------------
| AUTHOR                : Md.Meherul Islam
| -----------------------------------------------------
| EMAIL                 : meherulsust@gmail.com
| -----------------------------------------------------
| COPYRIGHT             : Md.Meherul Islam
| -----------------------------------------------------
| WEBSITE               :
| -----------------------------------------------------
 */

class Home extends MT_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('download');
        $this->load->model(array('homemodel', 'menumodel'));
    }

    public function index()
    {
        $this->tpl->set_page_title('Admin : Home');
        $menu = $this->menumodel->get_home_menulist();
        $this->assign('menu', $menu);
        $this->load->view('home/home_page');
    }

    public function download_file($folder_path, $document_name)
    {
        $path = '../upload_file/' . $folder_path . '/' . $document_name;
        $data = file_get_contents($path);
        $file_name = $document_name;
        force_download($file_name, $data);
    }

}