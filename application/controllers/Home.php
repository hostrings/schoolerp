<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
	} 
	public function index(){
		$data['web_title'] = 'Home';
		$this->displayView('home/index',$data);
	}
	public function profile(){
		$this->load->model('model_user');
		$this->load->model('model_salaryhistory');
		$data['web_title'] = 'Profile';
		$license_id = $this->session->userdata('license_id');
		$user_id = $this->session->userdata('user_id');
		
		$data['post'] = array();
		if($this->input->post()){
			$post = $this->input->post();
			$this->load->library('form_validation');
			$valid = true;
			if($post['password'] != ''){
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('passwordconf', 'Confirm Password', 'trim|required|min_length[5]|matches[password]');
				$valid = $this->form_validation->run();
			}
			if ($valid == FALSE){
				$data['message_type'] = 'danger';
				$data['message'] = validation_errors('<div>','</div>');
			}else{
				$valid = true;
				if ($this->session->userdata('roles') == 'license_owner'){
					if($_FILES['user_employee_photo']['tmp_name'] != ''){
						$config['allowed_types'] = 'gif|jpg|png';
						$config['overwrite']  = true;
						
						$params = array('user_id'=>$user_id,'license_id'=>$license_id);
						$params['single'] = true;
						$getUser = $this->model_user->getUser($params);
						$employee_code = $getUser['employee_code'];
						
						$config['file_name']  = $this->session->userdata("license_id").$employee_code;
						$config['max_size']	= $this->max_file_size;
						$config['upload_path'] = "assets/uploads/employee_photo/".$this->session->userdata("license_id");
						$dataupload = $this->uploadfile('user_employee_photo',$config);
						if($dataupload['type']){
							$post['user_employee_photo'] = $dataupload['content']['file_name'];
							$this->session->set_userdata('user_employee_photo', $post['user_employee_photo']);
						}else{
							$data['message_type'] = 'danger';
							$data['message'] = $dataupload['content'];
							$valid = false;
							$data['post'] = $post;
						}
					}
				}
				if($valid){
					if($post['time_from'] == '') $post['time_from'] = "NULL";
					if($post['time_to'] == '') $post['time_to'] = "NULL";
					if($post['password'] != ''){
						$post['password'] = Auth::encryptPassword($post['password']);
					}else{
						unset($post['password']);
					}
					$this->model_user->update($post,array('user_id'=>$this->session->userdata('user_id')));
					
					$data['message_type'] = 'success';
					$data['message'] = 'Your profile has been updated.';
				}
			}
		}
		
		$params = array('user_id'=>$user_id,'license_id'=>$license_id);
		$params['single'] = true;
		$data['post'] = $this->model_user->getUser($params);
		$getSalaryhistory = $this->model_salaryhistory->getSalaryhistory(array('user_id'=>$user_id,'license_id'=>$license_id,'single'=>true));
		$data['post']['salary'] = $getSalaryhistory['salary'];
		$this->displayView('home/profile',$data);
	}
	public function logout(){
		Auth::logout();
		redirect('login');
	}
}
