<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_Model {
    
    public function get_todos($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('todos')->result();
    }
    
    public function add_todo($data) {
        return $this->db->insert('todos', $data);
    }
    
    public function update_todo($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('todos', $data);
    }

    function get_todo($id){
        $this->db->where('id', $id);
        return $this->db->get('todos')->row();
    }
    
    public function delete_todo($id) {
        $this->db->where('id', $id);
        return $this->db->delete('todos');
    }
}