<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();        
        $this->auth_lib->required_login();        
        $this->load->model('DashboardModel');
        $this->load->model('BookingsModel');
    }
    public function index(){

        $chart_week_obj = $this->DashboardModel->getDataByRange(); // data chart jumlah booking dalam minggu ini
        $label = array_map(fn($chart_week_obj) => [$chart_week_obj->hari,$chart_week_obj->tanggal] ,$chart_week_obj);        
        $data = [
            'chart_total_booking' => [
                'title' => 'Total Booking',
                'label' => json_encode($label),
                'data' => json_encode(array_map(fn($chart_week_obj) => $chart_week_obj->total_booking,$chart_week_obj))
            ],
            'summary_card' => [
                'total_room' => $this->DashboardModel->hitungDataTable('rooms'),
                'total_user' => $this->DashboardModel->hitungDataTable('users'),
                'total_room_booked' => $this->DashboardModel->hitungDataRoom($booked = true),
                'total_room_avaliable' => $this->DashboardModel->hitungDataRoom(),
            ],
            'booking_terbaru' => $this->BookingsModel->getAllByRange(date('Y-m-d'),date('Y-m-d'))
    
        ];                  
        $this->load->view('dashboard/index',$data);
    }   
}