<?php
class BookingsModel extends CI_Model {

    private $table = 'bookings';
    public function getAll($search_params='',$short_by_params=''){
        
        $this->db->select('bookings.id as id,rooms.name as nama_room,users.name as nama_user,status.name as status,start_time,end_time,purpose,canceled');
        $this->db->from($this->table);
        $this->db->join('users','bookings.user_id = users.id');
        $this->db->join('rooms','bookings.room_id = rooms.id');
        $this->db->join('status','bookings.status_id = status.id');
        if($search_params){
            $this->db->like('rooms.name',$search_params);
            $this->db->or_like('users.name',$search_params); 
            $this->db->or_like('purpose',$search_params); 
        }
        if($short_by_params){
            $this->db->order_by($short_by_params,'asc');
        }
        $this->db->order_by('bookings.id','asc');
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
    public function getDataById($id){
        return $this->db->get_where($this->table,['id' =>$id])->row();
    }

    public function is_time_slot_available($room_id, $start_time, $end_time){
        $this->db->select('bookings.id');
        $this->db->from('bookings');
        $this->db->join('status', 'status.id = bookings.status_id');
        $this->db->where('bookings.room_id', $room_id);
        $this->db->where('bookings.start_time <', $end_time);
        $this->db->where('bookings.end_time >', $start_time);
        $this->db->where_in('status.name', ['pending', 'approved']);

        $query = $this->db->get();

        return $query->num_rows() === 0;
    }

    // public function update($id,$data){
    //     $this->db->where('id',$id)->update('rooms',$data);
    // }

      public function getBookingByUserId($user_id,$canceled=0,$tgl = null){ 
        $this->db->select('bookings.id as id,rooms.name as nama_room,users.name as nama_user,status.name as status,start_time,end_time,purpose,canceled');
        $this->db->from($this->table);
        $this->db->join('users','bookings.user_id = users.id');
        $this->db->join('rooms','bookings.room_id = rooms.id');
        $this->db->join('status','bookings.status_id = status.id');
        $this->db->where('user_id',$user_id);
        $this->db->where('deleted',0);        
        $this->db->where('canceled',$canceled);        
        if($tgl){
            $this->db->like('start_time',$tgl,'after'); 
        }
        $result = $this->db->get()->result();
        return $result;
    }
     public function cancel_booked($booking_id){
        $this->db->set('canceled',1);
        $this->db->where('id',$booking_id);
        $this->db->update($this->table);
    }
      public function getAllByRange($start_time,$end_time){        
        $this->db->select('bookings.id as id,rooms.name as nama_room,users.name as nama_user,status.name as status,start_time,end_time,purpose,canceled');
        $this->db->from($this->table);
        $this->db->where('DATE(start_time) >=',$start_time);
        $this->db->where('DATE(start_time) <=',$end_time);
        $this->db->join('users','bookings.user_id = users.id');
        $this->db->join('rooms','bookings.room_id = rooms.id');
        $this->db->join('status','bookings.status_id = status.id');
        $result = $this->db->get()->result();
        return $result;        
    }
}