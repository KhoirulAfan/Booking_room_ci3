<?php

use Dompdf\Dompdf;

defined('BASEPATH') OR exit('No direct script access allowed');
class Bookings extends CI_Controller {    
    public function __construct(){
        parent::__construct();
        $this->auth_lib->required_login();
        $this->load->model('RoomsModel');
        $this->load->model('BookingsModel');
        $this->load->model('StatusModel');        
        $this->load->library('Booking_lib');
        $this->load->library('form_validation');

    }
    public function index(){
        $search = $this->input->get('search');        
        $this->auth_lib->required_admin();
        $data = [
            'data' =>$this->BookingsModel->getAll($search),
            'title' => 'Booking',
            'search' => $search?? ''
        ];                                
        $this->load->view('bookings/index',$data);        
    }

    public function update($id,$status){
        $this->auth_lib->required_admin();
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
        $this->auth_lib->required_admin();
        $data = [
            'title' => 'Create data booking',
            'rooms' =>  $this->RoomsModel->getAllRooms(),
            'status' => $this->StatusModel->getAllStatus()
        ];
        $this->load->view('bookings/create',$data);
    }
    public function store(){        
        $this->auth_lib->required_admin();
        // validation        
        $this->form_validation->set_rules('status_id','Status','required');
        $this->form_validation->set_rules('room_id','Room','required');
        $this->form_validation->set_rules('start_time','start time','required');
        $this->form_validation->set_rules('end_time','end time','required');
        $this->form_validation->set_rules('purpose','Purpose','required|min_length[5]');

        if($this->form_validation->run() === false){            
             $data = [
                'title' => 'Create data booking',
                'rooms' =>  $this->RoomsModel->getAllRooms(),
                'status' => $this->StatusModel->getAllStatus()
                ];
            $this->load->view('bookings/create',$data);
        }else{             
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'status_id' => $this->input->post('status_id'),
                'room_id' => $this->input->post('room_id'),
                'start_time' => date('Y-m-d').' '.$this->input->post('start_time').':00',
                'end_time' => date('Y-m-d').' '.$this->input->post('end_time').':00',
                'purpose' => $this->input->post('purpose')
            ];
            if (!$this->BookingsModel->is_time_slot_available($data['room_id'], $data['start_time'], $data['end_time'])) {
                $this->session->set_flashdata('error', 'Waktu booking bentrok. Silakan pilih waktu lain.');
                redirect('bookings/create');
            }        
            $this->booking_lib->check_start_end_time($data['start_time'],$data['end_time']);        
            $this->BookingsModel->insert($data);
            $this->session->set_flashdata('success','berhasil menambahkan data booking');
            redirect('bookings');
        }

    }
    
    public function booked($tanggal = null){        
        $user_id = $this->session->userdata('user_id');
        $data = [
            'title' => 'Booked',
            'data' => $this->BookingsModel->getBookingByUserId($user_id)
        ];
        
        $this->load->view('bookings/booked',$data);
    }
    public function cancel_booked($booking_id){        
        $this->BookingsModel->cancel_booked($booking_id);
        $this->session->set_flashdata('success','Successfull canceling booked room');
            redirect('booked');
    }

    public function canceled(){
        $user_id = $this->session->userdata('user_id');
        $data = [
            'title' => 'Canceled Booking',
            'data' => $this->BookingsModel->getBookingByUserId($user_id,1)
        ];
        $this->load->view('bookings/canceled',$data);
    }

    public function print(){
        $this->auth_lib->required_admin();
        $all = $this->input->get('all');
        $start_time = $this->input->get('tanggal_mulai');
        $end_time = $this->input->get('tanggal_selesai');
        $judul = $this->input->get('judul');
        $subjudul = $this->input->get('subjudul');
        if($all){
            $data = [
                'judul' => $judul,
                'subjudul' => $subjudul,
                'data' =>$this->BookingsModel->getAll(),                
            ];                                
            $this->load->view('bookings/print',$data);   
        }else{
            $data = [
            'judul' => $judul,
            'data' =>$this->BookingsModel->getAllByRange($start_time,$end_time),
            ];                                
            $this->load->view('bookings/print',$data);   
        }
    }

    public function download_pdf(){
        $dompdf = new Dompdf();
        $judul = $this->input->get('judul');
        $data = [
                'judul' => $judul,                
                'data' =>$this->BookingsModel->getAll(),                
        ];
        $view = $this->load->view('bookings/download',$data,true);
        $dompdf->load_html($view);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream($judul.'.pdf',['Attachment' => 1]);
    }
}