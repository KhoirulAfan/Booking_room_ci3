<?php
class StatusModel extends CI_Model {
    public function getAllStatus(){
        return $this->db->get('status')->result(); 
    }
}