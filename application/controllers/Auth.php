<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function login() {
        if($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $user = $this->user_model->login($username, $password);
            
            if($user) {
                $user_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($user_data);
                redirect('todo');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth/login');
            }
        }
        
        $this->load->view('auth/login');
    }
    
    public function register() {
        if($this->input->post()) {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );
            
            if($this->user_model->register($data)) {
                $this->session->set_flashdata('success', 'Registration successful');
                redirect('auth/login');
            }
        }
        
        $this->load->view('auth/register');
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}