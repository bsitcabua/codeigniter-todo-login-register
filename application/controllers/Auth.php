<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends User_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('user_model');
	}

	public function login()
	{
        $this->logged_in();

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {

            $user = $this->user_model->check_email($this->input->post('email'));

            // $user->row()->password return single row
            if($user->num_rows() > 0 && password_verify($this->input->post('password'), $user->row()->password)){

                $user_session = array(
                    'id'        => $user->row()->id,
                    'email'     => $user->row()->email,
                    'first_name'=> $user->row()->first_name,
                    'last_name' => $user->row()->last_name,
                    'logged_in' => TRUE
                );
                // Set session
                $this->session->set_userdata($user_session);
                redirect('/todo', 'refresh');
            }
            else{
                // Invalid credentials
                $this->session->set_flashdata('email',$this->input->post('email'));
                $this->session->set_flashdata('err_msg','Invalid credentials');
            }
        }
        else{
            $this->session->set_flashdata('email',$this->input->post('email'));
        }

		$this->load->view('login');
    }
    
    public function register()
    {
        $this->logged_in();

        $this->form_validation->set_rules('first_name', 'Firstname', 'required');
        $this->form_validation->set_rules('last_name', 'Lastname', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules(
            'email', 'Email',
            'required|valid_email|is_unique[users.email]',
            array(
                'is_unique' => 'This %s already exists.'
            )
        );

        if ($this->form_validation->run() == TRUE) {
            // Register account
        
            $user_data = array(
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'email'         => $this->input->post('email'),
                'password'      => password_hash($this->input->post('password'), PASSWORD_BCRYPT, ['cost' => 12]),
            );

            if($user_id = $this->user_model->create($user_data)){

                $user_session = array(
                    'id'        => $user_id,
                    'email'     => $this->input->post('email'),
                    'first_name'=> $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'logged_in' => TRUE
                );
                // Set session
                $this->session->set_userdata($user_session);
                redirect('/todo', 'refresh');
            }
        }

        // Set to flashdata
        $this->session->set_flashdata('email',$this->input->post('email'));
        $this->session->set_flashdata('first_name',$this->input->post('first_name'));
        $this->session->set_flashdata('last_name',$this->input->post('last_name'));

		$this->load->view('register');	
    }

    public function logout()
	{
		session_destroy();
		redirect('auth/login', 'refresh');
	}
}
