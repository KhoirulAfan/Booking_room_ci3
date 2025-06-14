<?php
class RoomsModel extends CI_Model {
    public function getAllRooms(){
        return $this->db->get('rooms')->result();
    }
    public function insert($data){
        $this->db->insert('rooms',$data);
        return $this->db->insert_id();
    }
    public function delete($id){
        $this->db->delete('rooms',['id' => $id]);
    }
    public function getDataById($id){
        return $this->db->get_where('rooms',['id' => $id])->row();
    }
    public function update($id,$data){
        $this->db->where('id',$id)->update('rooms',$data);
    }
    public function getDataByName($name){                
        return $this->db->get_where('rooms',['name' => $name])->row();
        
    }    
}