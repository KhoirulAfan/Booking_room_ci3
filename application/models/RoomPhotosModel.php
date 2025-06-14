<?php
class RoomPhotosModel extends CI_Model {
    public function insert($data){
        $this->db->insert('room_photos',$data);
    }
    public function getDataById($id){
        return $this->db->get_where('room_photos',['room_id' => $id])->result();
    }
}