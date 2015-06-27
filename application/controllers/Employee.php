<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {
	private $parent_module_id = 3;
	public function __construct(){
		parent::__construct();
		$roles = $this->session->userdata('roles');
		if(!is_moduleAllowed($this->session->userdata('group_id'),$this->parent_module_id) ){
			echo '<script>top.location.href="'.site_url('login').'";</script>';
			exit;
		}		
		$this->load->model('model_user');
		$this->load->model('model_license');
		$this->load->model('model_group');
		$this->load->model('model_department');
		$this->load->model('model_qualification');
		$this->load->model('model_salaryhistory');

	} 
	public function index(){
		redirect('employee/employee_list');
	}
	public function username_check($str){
		$params['username'] = $str;
		$params['count'] = true;
		$count = $this->model_user->getUser($params);

		if($count == 0){
			return TRUE;
		}else{
			return FALSE;
			$this->form_validation->set_message('username_check', 'The {field} has been registered before. Please choose another one.');
		}
	}

	public function employee_registration(){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'employee/employee_registration') ) redirect('home');
		$license_id = $this->session->userdata('license_id');
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Employee Registration";
		$params['license_id'] = $license_id;
		$params['single'] = true;
		$data['getLicense'] = $this->model_license->getLicense($params);
		if(count($data['getLicense']) == 0) redirect('home');
		
		$data['post'] = array();
		if($this->input->post()){
			$post = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check|min_length[5]|max_length[30]',
				 array('is_unique' => '%s already exists. Please choose different one.')
			);
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('passwordconf', 'Confirm Password', 'trim|required|min_length[5]|matches[password]');
			if ($this->form_validation->run() == FALSE){
				$data['message_type'] = 'danger';
				$data['message'] = validation_errors('<div>','</div>');
				$data['post'] = $post;
			}else{
				$valid = true;
				if ($_FILES['user_employee_photo']['tmp_name'] != ''){
					$config['allowed_types'] = 'gif|jpg|png';
					$config['overwrite']  = true;
					$config['file_name']  = $this->session->userdata("license_id").$post['employee_code'];
					$config['max_size']	= $this->max_file_size;
					$config['upload_path'] = "assets/uploads/employee_photo/".$this->session->userdata("license_id");
					$dataupload = $this->uploadfile('user_employee_photo',$config);
					if($dataupload['type']){
						$post['user_employee_photo'] = $dataupload['content']['file_name'];
					}else{
						$data['message_type'] = 'danger';
						$data['message'] = $dataupload['content'];
						$valid = false;
						$data['post'] = $post;
					}
				}
				if($valid){
					$salary = $post['salary'];
					unset($post['salary']);
					if($post['time_from'] == '') unset($post['time_from']);
					if($post['time_to'] == '') unset($post['time_to']);
					if(!isset($post['employeement_status']) ) $post['employeement_status'] = 'not_active';
					$post['password'] = Auth::encryptPassword($post['password']);
					$post['passwordconf'] = Auth::encryptPassword($post['passwordconf']);
					unset($post['passwordconf']);
					$post['license_id'] = $license_id;
					$post['roles'] = 'staff';
					$post['created_date'] = date('Y-m-d H:i:s');
					$post['registered_by'] = $this->session->userdata('user_id');
					$total_today_employee = $this->model_user->getUser(array('created_date_start'=>date('Y-m-d 00:00:00'),'count'=>true));
					$total_today_employee = $total_today_employee + 1;
					while(strlen($total_today_employee) < 4) $total_today_employee = "0".$total_today_employee;
					$employee_code = date("mdY").$total_today_employee;
					$post['employee_code'] = $employee_code;
					$post['join_date'] = convert_date_by_timezone($post['join_date']);
					$post['leave_date'] = convert_date_by_timezone($post['leave_date']);
					$user_id = $this->model_user->insert($post);
					$insert_salary['user_id'] = $user_id;
					$insert_salary['input_date'] = date('Y-m-d H:i:s');
					$insert_salary['salary'] = $salary;
					$insert_salary['license_id'] = $license_id;
					$insert_salary['input_by_user_id'] = $this->session->userdata('user_id');

					$this->model_salaryhistory->insert($insert_salary);
					
					$account['username'] = $username;
					$account['password'] = $password;
					$account['from'] = $phone;
					$this->load->library('Sms_global' , $account);

					$this->sms_global->to('phone');
					$this->sms_global->message('A message goes in here.');
					$this->sms_global->send();

					$id = $this->sms_global->get_sms_id();

					$this->sms_global->print_debugger();

					$data['message_type'] = 'success';
					$data['message'] = 'New Employee has been added';
				}
			}
		}
		
		// get related module
		$data['getDepartment'] = $this->model_department->getDepartment(array('license_id'=>$license_id));
		$data['getQualification'] = $this->model_qualification->getQualification(array('license_id'=>$license_id));
		$data['getGroup'] = $this->model_group->getGroup(array('license_id'=>$license_id,'is_parent_group'=>'N'));
		
		$total_today_employee = $this->model_user->getUser(array('created_date_start'=>date('Y-m-d 00:00:00'),'count'=>true));
		$total_today_employee = $total_today_employee + 1;
		while(strlen($total_today_employee) < 4) $total_today_employee = "0".$total_today_employee;
		$employee_code = date("mdY").$total_today_employee;
		$data['employee_code'] = $employee_code;
		$this->displayView('employee/employee_registration',$data);
	}
	public function employee_list($offset=0){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'employee/employee_list') ) redirect('home');
		$license_id = $this->session->userdata('license_id');
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Employee List";
		$params['license_id'] = $license_id;
		$params['single'] = true;
		$data['getLicense'] = $this->model_license->getLicense($params);
		if(count($data['getLicense']) == 0) redirect('home');
		
		$params = array();
		$embedString = $data['keyword'] = "";
		if($this->input->get('q') ){
			$data['keyword'] = $params['keyword'] = urldecode($this->input->get('q'));
			$embedString = "?q=".$params['keyword'];
		}
		$params['license_id'] = $license_id;
		$params['count'] = true;
		$count = $this->model_user->getUser($params);
		unset($params['count']);
		//pagination area
		$config = $this->configpagination;
		$config['base_url']       = site_url('employee/employee_list');
		$config['uri_segment']    = 3;
		$config['total_rows']     = $count;
		$config['per_page']       = $this->per_page;
		$config['num_links']      = 5;
		$this->load->library('pagination', $config);
		$data['pagination']     = $this->pagination->create_links();
		$data['pagination']     = embedSuffixInPaging($embedString, $data['pagination']);
		$params['limit'] = $this->per_page;
		$params['offset'] = $offset;
		$data['offset'] = $offset;
		unset($params['count']);
		$data['lists'] = $this->model_user->getUser($params);
		$this->displayView('employee/employee_list',$data);
	}
	public function employee_delete($user_id=''){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'employee/employee_registration') ) redirect('home');
		if(!is_moduleAllowed($this->session->userdata('group_id'),'employee/employee_list') ) redirect('home');
		if($user_id == "") redirect('employee/employee_list');
		if($user_id == $this->session->userdata('user_id')) redirect('employee/employee_list');
		$params = array('user_id'=>$user_id);
		$params['single'] = true;
		$getUser = $this->model_user->getUser($params);
		if($getUser['roles'] == 'license_owner') redirect('employee/employee_list');
		$this->model_user->update(array('deleted'=>'Y'),$params);
		redirect('employee/employee_list');
	}
	
}
