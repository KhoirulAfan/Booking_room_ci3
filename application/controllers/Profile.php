<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('auth_lib');        
        $this->auth_lib->required_login();
    }
    public function index($name){        
        $namee = str_replace('%20',' ',$name);
        $data = [
            'judul'=> $namee,
            'data' => $this->UserModel->selectByName($namee)
        ];
        $this->load->view('profile/index',$data);
        $this->load->view('layout/footer.php');
    }
    
}