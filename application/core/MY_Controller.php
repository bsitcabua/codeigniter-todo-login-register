<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Manila");

class MY_Controller	extends CI_Controller {
    
    public function __construct()
	{
        parent::__construct();
    }
}

class Admin_Controller extends MY_Controller {

}

class User_Controller extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();

        if(empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
		}
    }


    public function logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == TRUE) {
			redirect('/todo', 'refresh');
		}
	}

	public function not_logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == FALSE) {
			redirect('/auth/login', 'refresh');
		}
	}

	public function render_template($page = null, $data = array())
	{

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view($page, $data);
		$this->load->view('templates/footer',$data);
	}
}