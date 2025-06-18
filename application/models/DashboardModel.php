<?php
class DashboardModel extends CI_Model {
    public function getDataByRange(){
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
        $sql1 = "
            SELECT count(*) as jumlah_room from rooms as r 
            join bookings as b on (b.room_id = r.id) 
            join status on (b.status_id = status.id) 
            WHERE
            ";         
        $sql2 = "NOT(";
        $sql3 = "
                now() >= b.start_time 
                AND 
                now() <= b.end_time 
                AND
                status.name = 'approved'                 
                ";
        $sql4 = ")";
        $sql5 = ";";
        
        if($booked){
            $sql = $sql1.$sql3.$sql5;
        }else{
            $sql = $sql1.$sql2.$sql3.$sql4.$sql5;
            
        }
        $query = $this->db->query($sql);                 
        $data = $query->row()->jumlah_room;
        return str_pad($data,2,0,STR_PAD_LEFT);
    }
}