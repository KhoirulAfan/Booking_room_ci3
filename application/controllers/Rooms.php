<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rooms extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('RoomsModel');
        $this->load->model('RoomPhotosModel');
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
        $dataroom = [
            'name'=> $this->input->post('name'),
            'location'=> $this->input->post('location'),
            'capacity'=> $this->input->post('capacity'),
            'description'=> $this->input->post('description')            
        ];
        $id_room = $this->RoomsModel->insert($dataroom); 
        $files = $_FILES; 
        $jumlah_file = count($_FILES['gambar']['name']);
        print_r('<pre>');
        print_r($_FILES['gambar']['name']['0']);
        print_r('</pre>');
        for($i=0;$i < $jumlah_file;$i++){
            if(!empty($_FILES['gambar']['name'][$i])){
                $_FILES['gambar']['name']     = $files['gambar']['name'][$i];
                $_FILES['gambar']['type']     = $files['gambar']['type'][$i];
                $_FILES['gambar']['tmp_name'] = $files['gambar']['tmp_name'][$i];
                $_FILES['gambar']['error']    = $files['gambar']['error'][$i];
                $_FILES['gambar']['size']     = $files['gambar']['size'][$i];

                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);

                if($this->upload->do_upload('gambar')){
                    $data_upload = $this->upload->data();
                    $data_gambar = [
                        'room_id' => $id_room,
                        'filename' => $data_upload['file_name']
                    ];
                    $this->RoomPhotosModel->insert($data_gambar);
                }
            }
        }
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