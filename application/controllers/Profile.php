<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		$this->data['page_title'] = 'Profile';
    }
    
    public function index()
	{
        $this->data['custom_js'] = 'profile.js';
		$this->render_template('profile/index', $this->data);	
	}
}
