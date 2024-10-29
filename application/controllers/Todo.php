<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('todo_model');
        
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    public function index() {
        $data['todos'] = $this->todo_model->get_todos($this->session->userdata('user_id'));
        $this->load->view('todo/index', $data);
    }
    
    public function add() {
        if($this->input->post()) {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description')
            );
            
            if($this->todo_model->add_todo($data)) {
                $this->session->set_flashdata('success', 'Todo added successfully');
            }
            redirect('todo');
        }
        
        $this->load->view('todo/add');
    }

    public function edit($id) {
        $todo = $this->todo_model->get_todo($id);
        
        // Pastikan todo milik user yang sedang login
        if($todo->user_id != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'You are not authorized to edit this todo');
            redirect('todo');
        }
        
        if($this->input->post()) {
            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description')
            );
            
            if($this->todo_model->update_todo($id, $data)) {
                $this->session->set_flashdata('success', 'Todo updated successfully');
                redirect('todo');
            }
        }
        
        $data['todo'] = $todo;
        $this->load->view('todo/edit', $data);
    }
    
    public function complete($id) {
        $data = array('status' => 'completed');
        if($this->todo_model->update_todo($id, $data)) {
            $this->session->set_flashdata('success', 'Todo marked as completed');
        }
        redirect('todo');
    }
    
    public function delete($id) {
        if($this->todo_model->delete_todo($id)) {
            $this->session->set_flashdata('success', 'Todo deleted successfully');
        }
        redirect('todo');
    }
}