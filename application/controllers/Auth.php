<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('AuthModel');          
    }
    public function login(){
        if($this->auth_lib->is_logged_in()){
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }
    
   public function loginProccess()
   {
        if($this->auth_lib->is_logged_in()){
            redirect('dashboard');
        }
        $data = [
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        ];
        $user = $this->AuthModel->checkLogin($data);
        if($user){
            $this->session->set_userdata([
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'level' => $user->level,
                'logged_in' => true
            ]);
            redirect('dashboard');
        }else{
            $this->session->set_flashdata('error','email atau password salah');
            redirect('auth/login');
        }
   }
   public function logout(){
    if(!$this->auth_lib->is_logged_in()){
        redirect('auth/login');
    }
    $this->session->sess_destroy();
    redirect('auth/login');
   }
}