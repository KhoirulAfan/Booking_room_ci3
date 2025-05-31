<?php
class BookingsModel extends CI_Model {

    private $table = 'bookings';
    public function getAll(){
        
        $this->db->select('bookings.id as id,rooms.name as nama_room,users.name as nama_user,status.name as status,start_time,end_time,purpose');
        $this->db->from($this->table);
        $this->db->join('users','bookings.user_id = users.id');
        $this->db->join('rooms','bookings.room_id = rooms.id');
        $this->db->join('status','bookings.status_id = status.id');
        $result = $this->db->get()->result();
        return $result;        
    }

    public function approve($id){
        $this->db->set('status_id',2);
        $this->db->where('id',$id);
        $this->db->update($this->table);
    }
    public function reject($id){
        $this->db->set('status_id',3);
        $this->db->where('id',$id);
        $this->db->update($this->table);
    }
    public function insert($data){
        $this->db->insert($this->table,$data);
    }
    // public function insert($data){
    //     $this->db->insert('rooms',$data);
    // }
    // public function delete($id){
    //     $this->db->delete('rooms',['id' => $id]);
    // }
    // public function getDataById($id){
    //     return $this->db->get_where('rooms',['id' =>$id])->row();
    // }
    // public function update($id,$data){
    //     $this->db->where('id',$id)->update('rooms',$data);
    // }
}