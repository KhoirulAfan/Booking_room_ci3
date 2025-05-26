<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bookings extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('BookingsModel');
    }
    public function index(){
        $data = [
            'data' => $this->BookingsModel->getAll(),
            'title' => 'Booking'
        ];                                
        $this->load->view('bookings/index',$data);
        
    }
    public function show(){
    }
    public function create(){
    }
    public function store(){
    }
    public function edit(){
    }
    public function update(){
    }
    public function delete(){
    }
}