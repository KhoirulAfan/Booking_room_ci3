<?php
class AuthModel extends CI_Model {

    public function checkLogin($data){
         
        $this->db->where('email', $data['email']);
        $this->db->where('password', md5($data['password'])); 
        return $this->db->get('users')->row();
    
    }
}