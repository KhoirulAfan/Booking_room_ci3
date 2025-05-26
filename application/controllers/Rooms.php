<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rooms extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('RoomsModel');
        $this->auth_lib->required_login();        
    }
    public function index(){

        $data = [
            'title' => 'Rooms',
            'data' => $this->RoomsModel->getAllRooms(),
        ];

        $this->load->view('rooms/index',$data);
    }
    public function create(){
        $this->auth_lib->required_admin();
        $data = [
            'title' => 'Create new room data'
        ];
        $this->load->view('rooms/create',$data);
    }
    public function store(){
        $this->auth_lib->required_admin();
        $this->RoomsModel->insert([
            'name'=> $this->input->post('name'),
            'location'=> $this->input->post('location'),
            'capacity'=> $this->input->post('capacity'),
            'description'=> $this->input->post('description')            
        ]);                
        redirect('rooms');
    }
    public function delete($id){
        $this->auth_lib->required_admin();
        $this->RoomsModel->delete($id);
        redirect('rooms');
    }
    public function edit($id){
        $this->auth_lib->required_admin();
        $data['title'] = 'Form Edit data';
        $data['rooms'] = $this->RoomsModel->getDataByid($id);
        $this->load->view('rooms/edit',$data);
    }
    public function update($id){
        $this->auth_lib->required_admin();
        $this->RoomsModel->update($id,[            
            'name'=> $this->input->post('name'),
            'location'=> $this->input->post('location'),
            'capacity'=> $this->input->post('capacity'),
            'description'=> $this->input->post('description')            
        ]);
        redirect('rooms');
    }
}