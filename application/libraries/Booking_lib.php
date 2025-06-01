<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Booking_lib{
    protected $CI;
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('BookingsModel');
    }
    public function check_days($id){
        $data = $this->CI->BookingsModel->getDataById($id);
        if(date('Y-m-d',strtotime($data->start_time)) !== date('Y-m-d')){
            $this->CI->session->set_flashdata('error','You are late');
            return redirect('bookings');
        }
    }

    public function check_start_end_time($start_time,$end_time){        
        if(!strtotime($start_time)< strtotime($end_time)){
            $this->CI->session->set_flashdata('error','Waktu mulai harus lebih awal daripada Waktu selesai');
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }
}