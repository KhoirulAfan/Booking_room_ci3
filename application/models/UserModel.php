<?php
class UserModel extends CI_Model {
    public function selectByName($name){
        $this->db->select('name,email,level');
        $result = $this->db->get_where('users',['name' => $name])->row();
        return $result;
    }
}