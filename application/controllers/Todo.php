<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		$this->data['page_title'] = 'Todo';

		$this->load->model('todo_model');
	}

	public function index()
	{
		$where = array('user_id' => $this->session->userdata('id'));
		$todos = $this->todo_model->get_where($where);
		
		$this->data['todos'] = $todos;
		$this->data['custom_js'] = 'todo.js';
		$this->render_template('todo/index', $this->data);	
	}

	public function fetchTodos()
	{
		$where = array('user_id' => $this->session->userdata('id'));
		$todos = $this->todo_model->get_where($where);

		$this->output->set_output(json_encode(
			array('todos' => $todos->result(), 'status' => 200)
		));
	}

	public function store()
	{
		$this->form_validation->set_rules(
            'name', 'Todo',
            'required|is_unique[todos.name]',
            array(
                'is_unique' => 'This %s already exists.'
            )
        );

		if ($this->form_validation->run() == TRUE) {

			$todo_data = array(
                'name'		=> $this->input->post('name'),
                'user_id'	=> $this->session->userdata('id'),
            );

            if($todo_id = $this->todo_model->create($todo_data)){

				$this->output->set_output(json_encode(
					array('msg' => 'Todo successfully added', 'status' => 200)
				));
			}
			else{
				$this->output->set_output(json_encode(
					array('msg' => 'Todo couldn\'t add', 'status' => 401)
				));
			}
		}
		else{
			// Error validates
			$this->output->set_output(json_encode(
				array('validator' => $this->form_validation->error_array(), 'status' => 402)
			));
		}
	}

	public function markAsDone()
	{
		$id = $this->input->post('id');

		$where 	= array('id' => $id);
		$data 	= array('is_done' => 1);

		$this->todo_model->update($where, $data);

		$this->output->set_output(json_encode(
			array('msg' => 'Todo successfully updated', 'status' => 200)
		));
	}

	public function markAllAsDone()
	{
		$where 	= array('user_id' => $this->session->userdata('id'));
		$data 	= array('is_done' => 1);

		$this->todo_model->update($where, $data);

		$this->output->set_output(json_encode(
			array('msg' => 'Todo successfully updated', 'status' => 200)
		));
	}

	public function undo()
	{
		$id = $this->input->post('id');

		$where 	= array('id' => $id);
		$data 	= array('is_done' => 0);

		$this->todo_model->update($where, $data);

		$this->output->set_output(json_encode(
			array('msg' => 'Todo successfully updated', 'status' => 200)
		));
	}

	public function destroy()
	{
		$id = $this->input->post('id');

		$where 	= array('id' => $id);

		$this->todo_model->destroy($where);

		$this->output->set_output(json_encode(
			array('msg' => 'Todo successfully updated', 'status' => 200)
		));
	}
}
