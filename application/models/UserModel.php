<?php
class UserModel extends CI_Model {
    public function selectByName($name){
        return $this->db->get_where('users',['name' => $name])->row();        
    }
}