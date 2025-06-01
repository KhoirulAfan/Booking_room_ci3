<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bookings extends CI_Controller {    
    public function __construct(){
        parent::__construct();
        $this->auth_lib->required_admin();
        $this->load->model('RoomsModel');
        $this->load->model('BookingsModel');
        $this->load->model('StatusModel');        
        $this->load->library('Booking_lib');
        $this->load->library('form_validation');
    }
    public function index(){
        $this->auth_lib->required_admin();
        $data = [
            'data' => $this->BookingsModel->getAll(),
            'title' => 'Booking'
        ];                                
        $this->load->view('bookings/index',$data);
        
    }

    public function update($id,$status){
        
        $this->booking_lib->check_days($id);
        if($status === 'reject'){
            $this->BookingsModel->reject($id);
            $this->session->set_flashdata('success','Successfull rejected bookings data');
            redirect('bookings');
        }elseif($status === 'approve'){
            $this->BookingsModel->approve($id);
            $this->session->set_flashdata('success','Successfull approved bookings data');
            redirect('bookings');
        }else{
            $this->session->set_flashdata('error','Ada sedikit kesalahan');
        }
    }
    
    public function show(){
    }
    public function create(){
        $data = [
            'title' => 'Create data booking',
            'rooms' =>  $this->RoomsModel->getAllRooms(),
            'status' => $this->StatusModel->getAllStatus()
        ];
        $this->load->view('bookings/create',$data);
    }
    public function store(){        
        // validation
        $this->form_validation->set_rules('user_id','User id','required');
        $this->form_validation->set_rules('status_id','Status','required');
        $this->form_validation->set_rules('room_id','Room','required');
        $this->form_validation->set_rules('start_time','start time','required');
        $this->form_validation->set_rules('end_time','end time','required');
        $this->form_validation->set_rules('purpose','Purpose','required|min_length[5]');

        if(!$this->form_validation->run()){
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'status_id' => $this->input->post('status_id'),
            'room_id' => $this->input->post('room_id'),
            'start_time' => date('Y-m-d').' '.$this->input->post('start_time').':00',
            'end_time' => date('Y-m-d').' '.$this->input->post('end_time').':00',
            'purpose' => $this->input->post('purpose')
        ];        
        $this->booking_lib->check_start_end_time($data['start_time'],$data['end_time']);        
        $this->BookingsModel->insert($data);
        $this->session->set_flashdata('success','berhasil menambahkan data booking');
        redirect('bookings');
    }
    public function edit(){
    }   
    public function delete(){
    }
}