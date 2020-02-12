<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_Model {

    private $table = 'todos';

    public function get_where($where)
	{
		// $this->db->order_by('id', 'DESC');
		$result = $this->db->get_where($this->table, $where);
		return $result;
    }
    
    // Inser toto
    public function create($data)
	{
        $this->db->insert($this->table, $data);
        // Return id
		return $this->db->insert_id();
    }
    
    public function destroy($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table);
    }

    public function update($where, $data)
    {
        $this->db->where($where);
		return $this->db->update($this->table, $data);
    }

}