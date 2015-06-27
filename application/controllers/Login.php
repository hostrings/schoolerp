<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(Auth::isLoggedIn() ) redirect('home');
	} 
	public function index(){
		$data['stylesheets'][] = 'login.css';
		$this->load->view('login/index',$data);
	}
	public function verify(){
		if(!$this->input->is_ajax_request() ) exit;
		if($this->input->post() ){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$usertimezoneoffset = $this->input->post('usertimezoneoffset');
			$auth = Auth::login($username,$password);
			if($auth['type'] == true){
				$this->session->set_userdata('usertimezoneoffset', $usertimezoneoffset);
				$roles = $this->session->userdata('roles');
				$return['type'] = true;
				if($roles == "backend"){
					$return['message'] = site_url('admin');
				}else{
					$return['message'] = site_url('home');
				}
			}else{
				$return['type'] = $auth['type'];
				$return['message'] = $auth['message'];
			}
		}else{
			$return['type'] = false;
			$return['message'] = "Please input username and password.";
		}
		echo json_encode($return);
	}
}
