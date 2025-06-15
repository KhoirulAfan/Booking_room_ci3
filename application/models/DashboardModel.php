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
}