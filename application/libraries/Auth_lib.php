<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_lib{

    protected $CI;

        public function __construct(){
            $this->CI =& get_instance();
        }
    public function is_logged_in(){
        return $this->CI->session->userdata('logged_in') == true;
    }
    public function required_login(){
        if(!$this->is_logged_in()){
            $this->CI->session->set_flashdata('error','Mohon maaf anda harus login terlebih dahulu');
            redirect('auth/login');
        }
    }
    public function is_admin(){
        return $this->CI->session->userdata('level') === 'admin';
    }

    public function required_admin(){
        if(!$this->is_admin()){
            $this->CI->session->set_flashdata('error','Mohon maaf anda tidak memiliki akses untuk fitur ini');
            redirect($_SERVER['HTTP_REFERER'] ?? base_url());
        }
    }
}
?>