<?php
class RoomPhotosModel extends CI_Model {
    public function insert($data){
        $this->db->insert('room_photos',$data);
    }
}