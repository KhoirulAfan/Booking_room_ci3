<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();        
        $this->auth_lib->required_login();        
    }
    public function index(){
        $this->load->view('dashboard/index');
    }   
}