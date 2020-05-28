<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mt404 extends MT_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->output->set_status_header('404');
        $this->load->view('err404'); //loading in custom error view
    }
}