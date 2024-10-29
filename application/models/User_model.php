<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function register($data) {
        return $this->db->insert('users', $data);
    }
    
    public function login($username, $password) {
        $query = $this->db->get_where('users', array('username' => $username));
        if($query->num_rows() > 0) {
            $user = $query->row();
            if(password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }
}