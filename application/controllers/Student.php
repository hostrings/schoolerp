<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends MY_Controller {
	private $parent_module_id = 1;
	public function __construct(){
		parent::__construct();
		if(!is_moduleAllowed($this->session->userdata('student_id'),$this->parent_module_id) ){
			echo '<script>top.location.href="'.site_url('login').'";</script>';
			exit;
		}		
		$this->load->model('model_student');
		$this->load->model('model_license');
		
	} 
	public function index(){
		redirect('student/student_list');
	}

	public function student_registration(){
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Student Registration";
		$data['post'] = array();

		if($this->input->post()){
			$post = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('studentname', 'Student Name', 'trim|required');

			if ($this->form_validation->run() == TRUE){
				$data['message_type'] = 'danger';
				$data['message'] = validation_errors('<div>','</div>');
				$data['post'] = $post;
				$post['registdate'] = date('Y-m-d H:i:s');
				
				$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
				$total_today_student = $total_today_student + 1;
				while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
				$registration_code = date("mdY").$total_today_student;

				$post['registration_code'] = $registration_code;
				if ($_FILES['user_employee_photo']['tmp_name'] != ''){
					$config['allowed_types'] = 'gif|jpg|png';
					$config['overwrite']  = true;
					$config['file_name']  = $this->session->userdata("license_id").$post['registration_code'];
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
				$student_id = $this->model_student->insert($post);
				$insert_data['student_id'] = $student_id;
				
				$data['message_type'] = 'success';
				$data['message'] = 'New Student has been added';
			}
		}
		
		// get related module
		$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
		$total_today_student = $total_today_student + 1;
		while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
		$registration_code = date("mdY").$total_today_student;
		$data['registration_code'] = $registration_code;
		$this->displayView('student/student_registration',$data);

	}

	public function student_list($offset=0){
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Student List";
		
		$params = array();
		$embedString = $data['keyword'] = "";
		if($this->input->get('q') ){
			$data['keyword'] = $params['keyword'] = urldecode($this->input->get('q'));
			$embedString = "?q=".$params['keyword'];
		}
		$params['count'] = true;
		$count = $this->model_student->getStudent($params);
		unset($params['count']);
		//pagination area
		$config = $this->configpagination;
		$config['base_url']       = site_url('student/student_list');
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
		$data['lists'] = $this->model_student->getStudent($params);
		$this->displayView('student/student_list',$data);
	}

	public function admission_form(){
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Student Admission Form";
		
		$data['post'] = array();
		if($this->input->post()){
			$post = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('studentname', 'Student Name', 'trim|required');
			if ($this->form_validation->run() == TRUE){
				$data['message_type'] = 'danger';
				$data['message'] = validation_errors('<div>','</div>');
				$data['post'] = $post;
			
				$post['registdate'] = date('Y-m-d H:i:s');
				$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
				$total_today_student = $total_today_student + 1;
				while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
				$registration_code = date("mdY").$total_today_student;
				$post['registration_code'] = $registration_code;
				
				$student_id = $this->model_student->insert($post);

				$insert_data['student_id'] = $student_id;
				$insert_data['registdate'] = date('Y-m-d H:i:s');
				
				$data['message_type'] = 'success';
				$data['message'] = 'New Student Admission has been added';
			
			}
		}

		$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
		$total_today_student = $total_today_student + 1;
		while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
		$registration_code = date("mdY").$total_today_student;
		$data['registration_code'] = $registration_code;
		
		$this->displayView('student/admission_form',$data);
	}

	public function contact_info() {
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Student Contact Infomation";
		
		$data['post'] = array();
		if($this->input->post()){
			$post = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('studentname', 'Student Name', 'trim|required');
			if ($this->form_validation->run() == TRUE){
				$data['message_type'] = 'danger';
				$data['message'] = validation_errors('<div>','</div>');
				$data['post'] = $post;
			}
			$post['registdate'] = date('Y-m-d H:i:s');
			$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
			$total_today_student = $total_today_student + 1;
			while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
			$registration_code = date("mdY").$total_today_student;
			$post['registration_code'] = $registration_code;
			
			$data['message_type'] = 'success';
			$data['message'] = 'Load Success';
		}
		$registration_class = $this->input->get('registration_class');
		$data['registration_class'] = $registration_class;
		$section = $this->input->get('section');
		$data['section'] = $section;

		$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
		$total_today_student = $total_today_student + 1;
		while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
		$registration_code = date("mdY").$total_today_student;
		$data['registration_code'] = $registration_code;
		$this->displayView('student/contact_info',$data);
	}

	public function student_promotions() {
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Student Promotion";
		
		$data['post'] = array();
		if($this->input->post()){
			$post = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('studentname', 'Student Name', 'trim|required');
			if ($this->form_validation->run() == TRUE){
				$data['message_type'] = 'danger';
				$data['message'] = validation_errors('<div>','</div>');
				$data['post'] = $post;
			}else{
				$valid = true;
				if($valid){
					$post['registdate'] = date('Y-m-d H:i:s');
					$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
					$total_today_student = $total_today_student + 1;
					while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
					$registration_code = date("mdY").$total_today_student;
					$post['registration_code'] = $registration_code;
					
					$data['message_type'] = 'success';
					$data['message'] = 'Load Success';
				}
			}
		}

		$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
		$total_today_student = $total_today_student + 1;
		while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
		$registration_code = date("mdY").$total_today_student;
		$data['registration_code'] = $registration_code;
		$this->displayView('student/student_promotions',$data);
	}

	public function getCount() {
		$this->db->from("students");
		$query = $this->db->query(" SELECT section, COUNT(*) as strength FROM students group by section ");
		return $query->result_array();
	}

	public function student_strength() {
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Student Class Strength";
		
		$params = array();
		$embedString = $data['keyword'] = "";
		if($this->input->get('q') ){
			$data['keyword'] = $params['keyword'] = urldecode($this->input->get('q'));
			$embedString = "?q=".$params['keyword'];
		}
		$params['count'] = true;
		$count = $this->model_student->getStudent($params);
		unset($params['count']);
		//pagination area
		$config = $this->configpagination;
		$config['base_url']       = site_url('student/student_list');
		$config['uri_segment']    = 3;
		$config['total_rows']     = $count;
		$config['per_page']       = $this->per_page;
		$config['num_links']      = 5;
		$this->load->library('pagination', $config);
		$data['pagination']     = $this->pagination->create_links();
		$data['pagination']     = embedSuffixInPaging($embedString, $data['pagination']);
		$params['limit'] = $this->per_page;
		unset($params['count']);

		// $student_strength = $this->getCount();
		$data['lists'] = $this->getCount();
		
		$this->displayView('student/student_strength',$data);
	}

	public function student_leaving_form(){
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Student Leaving Form";
		
		$data['post'] = array();
		if($this->input->post()){
			$post = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('studentname', 'Student Name', 'trim|required');
			if ($this->form_validation->run() == TRUE){
				$data['message_type'] = 'danger';
				$data['message'] = validation_errors('<div>','</div>');
				$data['post'] = $post;
			}else{
				$valid = true;
				if($valid){
					$post['leavingdate'] = date('Y-m-d H:i:s');
					$total_today_student = $this->model_student->getStudent(array('leavingdate'=>date('Y-m-d 00:00:00'),'count'=>true));
					$total_today_student = $total_today_student + 1;
					while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
					$registration_code = date("mdY").$total_today_student;
					$post['registration_code'] = $registration_code;
					
					$data['message_type'] = 'success';
					$data['message'] = 'Load Success';
				}
			}
		}

		$total_today_student = $this->model_student->getStudent(array('leavingdate'=>date('Y-m-d 00:00:00'),'count'=>true));
		$total_today_student = $total_today_student + 1;
		while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
		$registration_code = date("mdY").$total_today_student;
		$data['registration_code'] = $registration_code;
		$this->displayView('student/student_leaving_form',$data);
	}

	public function student_comparison_report() {
		$parent_module_id = 95;
		$data['web_title'] = "Student Comparison Report";
		
		$data['post'] = array();
		if($this->input->post()){
			$post = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('studentname', 'Student Name', 'trim|required');
			if ($this->form_validation->run() == TRUE){
				$data['message_type'] = 'danger';
				$data['message'] = validation_errors('<div>','</div>');
				$data['post'] = $post;
			}else{
				$valid = true;
				if($valid){
					$post['registdate'] = date('Y-m-d H:i:s');
					$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
					$total_today_student = $total_today_student + 1;
					while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
					$registration_code = date("mdY").$total_today_student;
					$post['registration_code'] = $registration_code;
					
					$data['message_type'] = 'success';
					$data['message'] = 'Load Success';
				}
			}
		}

		$total_today_student = $this->model_student->getStudent(array('registdate'=>date('Y-m-d 00:00:00'),'count'=>true));
		$total_today_student = $total_today_student + 1;
		while(strlen($total_today_student) < 4) $total_today_student = "0".$total_today_student;
		$registration_code = date("mdY").$total_today_student;
		$data['registration_code'] = $registration_code;
		$this->displayView('reports/student_comparison_report',$data);
	}

	public function student_delete($student_id=''){
		if(!is_moduleAllowed($this->session->userdata('student_id'),'student/student_registration') ) redirect('home');
		if (!is_moduleAllowed($this->session->userdata('student_id'),'student/student_admission') ) redirect('home');
		if(!is_moduleAllowed($this->session->userdata('student_id'),'student/student_list') ) redirect('home');
		if($student_id == "") redirect('student/student_list');
		if($student_id == $this->session->userdata('student_id')) redirect('student/student_list');
		$params = array('user_id'=>$user_id);
		$params['single'] = true;
		$this->model_student->update(array('deleted'=>'Y'),$params);
		redirect('student/student_list');
	}
	
}
