<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
| -----------------------------------------------------
| LOADER CLASS NAME    : MTCMS
-----------------------------------------------------
| LOADER CLASS NAME    : MT_Loader
| -----------------------------------------------------
| AUTHOR               : Md.Meherul Islam
| -----------------------------------------------------
| EMAIL                : meherulsust@gmail.com
| -----------------------------------------------------
 */

class MT_Loader extends CI_Loader
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view($view, $params = array(), $flag = false)
    {
        $CI = &get_instance();
        if (!empty($CI->tpl->name)) {
            $view = $CI->tpl->name . '/' . $view;
        }

        $tpl_data = $CI->tpl->get_data();
        if (is_array($params)) {
            $params = array_merge($tpl_data, $params);
        } else {
            $params = $tpl_data;
        }
        $params['content_for_layout'] = parent::view($view, $params, true);
        $layout = $CI->tpl->get_layout();
        return parent::view($layout, $params, $flag);
    }

    public function element($file_name, $data = array(), $flag = false)
    {

        parent::view('elements/' . $file_name, $data, false);

    }
}