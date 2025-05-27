<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bookings extends CI_Controller {    
    public function __construct(){
        parent::__construct();
        $this->auth_lib->required_admin();
        $this->load->model('RoomsModel');
        $this->load->model('BookingsModel');
        $this->load->model('StatusModel');
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
        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'status_id' => $this->input->post('status_id'),
            'room_id' => $this->input->post('room_id'),
            'start_time' => date('d-m-Y').' '.$this->input->post('end_time'),
            'end_time' => date('d-m-Y').' '.$this->input->post('end_time'),
            'purpose' => $this->input->post('purpose')
        ];        
        $this->BookingsModel->insert($data);
        $this->session->set_flashdata('success','berhasil menambahkan data booking');
        redirect('bookings');
    }
    public function edit(){
    }   
    public function delete(){
    }
}