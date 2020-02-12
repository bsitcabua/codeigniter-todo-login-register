<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table = 'users';

    // Check email from database
    public function check_email($email)
	{
		return $this->db->get_where($this->table, array('email' => $email));
    }
    
    // Register account
    public function create($data)
	{
        $this->db->insert($this->table, $data);
        // Return id
		return $this->db->insert_id();
	}

}