<?php
class DashboardModel extends CI_Model {
    public function getDataWeek(){
        $query = $this->db->query("
            SELECT
            DATE_FORMAT(d.tanggal, '%W') AS hari,
            date_format(d.tanggal,'%d %b %Y') as tanggal,
            COUNT(b.id) AS total_booking
            FROM (
            SELECT DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL n DAY) AS tanggal
            FROM (
                SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2
                UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
            ) AS nums
            ) AS d
            LEFT JOIN bookings b ON DATE(b.start_time) = d.tanggal
            GROUP BY d.tanggal
            ORDER BY d.tanggal;

        ");
        return $query->result();
    }
    public function hitungDataTable($table){
        $data = $this->db->count_all($table);        
        return str_pad($data,2,0,STR_PAD_LEFT);
    }
    public function hitungDataRoom($booked = false){
        $db = 'rooms';
        // if(!$booked){
        //     $this->db->from($db);
        //     $this->db->join('bookings','rooms.id = bookings.room_id AND bookings.start')
        //     return;
        // }else{
        //     return 'booked';
        // }
    }
}