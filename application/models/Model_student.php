<?php
class Model_student extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getStudent($params=array()){
		if(isset($params['select'])) {
			foreach($params['select'] as $select) {
				if(is_array($select)) {
					foreach($select as $sel)
						$this->db->select($sel, false);
				} else {
					$this->db->select($select, false);
				}
			}
		}
		$this->db->from("students");
		$this->db->where('deleted','N');
		
		if(isset($params['student_id']) ) $this->db->where('student_id' ,$params['student_id']);
		if(isset($params['email']) ) $this->db->where('email',$params['email']);
		if(isset($params['reference_no']) ) $this->db->where('reference_no',$params['reference_no']);
		if(isset($params['studentname']) ) $this->db->where('studentname',$params['studentname']);
		if(isset($params['phone_father']) ) $this->db->where('phone_father',$params['phone_father']);
		if(isset($params['phone_mother']) ) $this->db->where('phone_mother',$params['phone_mother']);
		if(isset($params['religion']) ) $this->db->where('religion',$params['religion']);
		if(isset($params['family_code']) ) $this->db->where('family_code',$params['family_code']);
		if(isset($params['present_address']) ) $this->db->where('present_address',$params['present_address']);
		if(isset($params['nic_no']) ) $this->db->where('nic_no',$params['nic_no']);
		if(isset($params['fathername']) ) $this->db->where('fathername',$params['fathername']);
		if(isset($params['discount']) ) $this->db->where('discount',$params['discount']);
		if(isset($params['section']) ) $this->db->where('section',$params['section']);
		if(isset($params['father_nic_no']) ) $this->db->where('father_nic_no',$params['father_nic_no']);
		if(isset($params['leavingdate']) ) $this->db->where('leavingdate',$params['leavingdate']);
		if(isset($params['leaving_remarks']) ) $this->db->where('leaving_remarks',$params['leaving_remarks']);
		if(isset($params['prev_school_name']) ) $this->db->where('prev_school_name',$params['prev_school_name']);
		if(isset($params['brothername']) ) $this->db->where('brothername',$params['brothername']);
		if(isset($params['brother_class']) ) $this->db->where('brother_class',$params['brother_class']);
		if(isset($params['sistername']) ) $this->db->where('sistername',$params['sistername']);
		if(isset($params['sister_class']) ) $this->db->where('sister_class',$params['sister_class']);
		if(isset($params['sort_order']) ) $this->db->where('sort_order',$params['sort_order']);
		if(isset($params['registdate']) ) $this->db->where('registdate >=',$params['registdate']);
		
		if(!isset($params['order_by']) ) $params['order_by'] = 'studentname asc';

		if(isset($params['count']) ){
			$return = $this->db->count_all_results();
		}else{
			$query = $this->db->get();
			$return = $query->result_array();
		}

		return $return;
	}
	
	public function insert($insert_data) {

		$insert_data['student_id'] = generateUniqueID('students','student_id');
		$insert_data['gender'] = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
		$insert_data['current_class'] = isset($_REQUEST['current_class']) ? $_REQUEST['current_class'] : '';
		$insert_data['registration_class'] = isset($_REQUEST['registration_class']) ? $_REQUEST['registration_class'] : '';
		$insert_data['religion'] = isset($_REQUEST['religion']) ? $_REQUEST['religion'] : '';
		$insert_data['section'] = isset($_REQUEST['section']) ? $_REQUEST['section'] : '';
		$insert_data['fee_package'] = isset($_REQUEST['fee_package']) ? $_REQUEST['fee_package'] : '';
		$insert_data['nationality'] = isset($_REQUEST['nationality']) ? $_REQUEST['nationality'] : '';
		$insert_data['ethnicity'] = isset($_REQUEST['ethnicity']) ? $_REQUEST['ethnicity'] : '';
		$insert_data['prev_school_name'] = isset($_REQUEST['prev_school_name']) ? $_REQUEST['prev_school_name'] : '';

		$this->db->insert('students', $insert_data);
		return $insert_data;
	
	}


	public function updateRegistration($insert_data,$params=array()){
		if(isset($params['student_id']) ) $this->db->where('student_id',$params['student_id']);
		if(isset($params['registration_code']) ) $this->db->where('registration_code',$params['registration_code']);
		if(isset($params['studentname']) ) $this->db->where('studentname',$params['studentname']);
		if(isset($params['email']) ) $student->where('email',$params['email']);
		$this->db->update('students', $insert_data);
		
	}	

	public function updateAdmission($insert_data,$params=array()){
		if(isset($params['student_id']) ) $this->db->where('student_id',$params['student_id']);
		if(isset($params['studentname']) ) $this->db->where('studentname',$params['studentname']);
		if(isset($params['email']) ) $student->where('email',$params['email']);
		$this->db->update('students', $insert_data);
		
	}	
}