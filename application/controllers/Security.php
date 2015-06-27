<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends MY_Controller {
	private $parent_module_id = 11;
	public function __construct(){
		parent::__construct();
		$roles = $this->session->userdata('roles');
		if(!is_moduleAllowed($this->session->userdata('group_id'),$this->parent_module_id) ){
			echo '<script>top.location.href="'.site_url('login').'";</script>';
			exit;
		}
		$this->load->model('model_module');
		$this->load->model('model_user');
		$this->load->model('model_license');
		$this->load->model('model_group');
		$this->load->model('model_groupmodule');
		$this->load->model('model_department');
		$this->load->model('model_qualification');
	} 
	public function index(){
		redirect('security/institute_list');
	}
	public function institute_information(){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/institute_information') ) redirect('home');
		$license_id = $this->session->userdata('license_id');
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Institute Information";
		$params['license_id'] = $license_id;
		$params['single'] = true;
		$data['getLicense'] = $this->model_license->getLicense($params);
		if(count($data['getLicense']) == 0) redirect('home');
		
		if($this->input->post()){
			$school = $this->input->post('school');
			$this->model_license->update($school,array('license_id'=>$license_id));
			$data['message_type'] = 'success';
			$data['message'] = 'Institute has been updated';
		}
		
		$data['getLicense'] = $this->model_license->getLicense($params);
		$params['is_parent_group'] = 'Y';
		$getGroup = $this->model_group->getGroup($params);
		$params2['group_id'] = $getGroup['group_id'];
		$params2['select'][] = 'group_module.module_id';
		$getGroupModule = $this->model_groupmodule->getGroupModule($params2);
		$data['module_list'] = array();
		foreach($getGroupModule as $gm){
			$data['module_list'][] = $gm['module_id'];
		}
		$data['total_module'] = count($data['module_list']);
		$getModule_parent = $this->model_module->getModule(array('module_parent_id'=>0));
		$data['getModule_parent'] = $getModule_parent;
		$data['getModule_child'] = array();
		$data['getModule_grandchild'] = array();
		foreach($getModule_parent as $p){
			$data['getModule_child'][$p['module_id']] = $this->model_module->getModule(array('module_parent_id'=>$p['module_id']));
			foreach($data['getModule_child'][$p['module_id']] as $child){
				$data['getModule_grandchild'][$child['module_id']] = $this->model_module->getModule(array('module_parent_id'=>$child['module_id']));
			}
		}
		$this->displayView('security/institute_detail',$data);
	}
	public function security_rights($offset=0){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/security_rights') ) redirect('home');
		$license_id = $this->session->userdata('license_id');
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Security Rights";
		
		$params['license_id'] = $license_id;
		$params['group_id'] = $this->session->userdata('group_id');
		$params['single'] = true;
		$getGroup = $this->model_group->getGroup($params);
		$params2['group_id'] = $getGroup['group_id'];
		$params2['select'][] = 'group_module.module_id';
		$getGroupModule = $this->model_groupmodule->getGroupModule($params2);
		$data['module_list'] = array();
		foreach($getGroupModule as $gm){
			$data['module_list'][] = $gm['module_id'];
		}
		$data['total_module'] = count($data['module_list']);
		
		$params = array();
		$params['license_id'] = $license_id;
		$embedString = $data['keyword'] = "";
		if($this->input->get('q') ){
			$data['keyword'] = $params['keyword'] = urldecode($this->input->get('q'));
			$embedString = "?q=".$params['keyword'];
		}
		$params['is_parent_group'] = 'N';
		$params['count'] = true;
		$params['join_user'] = true;
		$count = $this->model_group->getGroup($params);
		//pagination area
		$config = $this->configpagination;
		$config['base_url']       = site_url('security/security_rights');
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
		$data['lists'] = $this->model_group->getGroup($params);
		
		$getModule_parent = $this->model_module->getModule(array('module_parent_id'=>0));
		$data['getModule_parent'] = $getModule_parent;
		$data['getModule_child'] = array();
		$data['getModule_grandchild'] = array();
		foreach($getModule_parent as $p){
			$data['getModule_child'][$p['module_id']] = $this->model_module->getModule(array('module_parent_id'=>$p['module_id']));
			foreach($data['getModule_child'][$p['module_id']] as $child){
				$data['getModule_grandchild'][$child['module_id']] = $this->model_module->getModule(array('module_parent_id'=>$child['module_id']));
			}
		}
		$this->displayView('security/security_rights',$data);
	}
	public function add_group(){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/security_rights') ) exit;
		$group_name = trim($this->input->post('group_name'));
		$modules = $this->input->post('modules');
		if(strlen($group_name) == 0){
			echo "Please fill the required fields";
			exit;
		}
		$insert_data = array(
			'group_name' => $group_name,
			'group_add_date' => date('Y-m-d H:i:s'),
			'group_modification_date' => date('Y-m-d H:i:s'),
			'license_id' => $this->session->userdata('license_id'),
			'creator_user_id' => $this->session->userdata('user_id'),
			'is_parent_group' => 'N'
		);
		$group_id = $this->model_group->insert($insert_data);
		$insert_batch = array();
		if(is_array($modules)){
			$module_input = array();
			foreach($modules as $modulparent => $moduls){
				if(!in_array($modulparent,$module_input)){
					$insert_batch[] = array(
						'group_id'=>$group_id,
						'module_id'=>$modulparent
					);
					$module_input[] = $modulparent;
				}
				foreach($moduls as $modul){
					if(!in_array($modul,$module_input)){
						$insert_batch[] = array(
							'group_id'=>$group_id,
							'module_id'=>$modul
						);
						$module_input[] = $modul;
					}
				}
			}
			$this->model_groupmodule->insert_batch($insert_batch);
		}
		echo "success";
		$this->session->set_flashdata('message',array('message_type'=>'success','message'=>'New Designation has been added'));
	}
	public function edit_group(){
		$group_id = trim($this->input->post('group_id'));
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/security_rights') ){
			echo "Sorry, you don't have permission to edit Designation";
			exit;
		}
		if($group_id == '' || $group_id == 'NULL'){
			echo "Oops. There was something error. Please refresh this page.";
			exit;
		}
		$group_name = trim($this->input->post('group_name'));
		$license_id = $this->session->userdata('license_id');
		
		$params['license_id'] = $license_id;
		$params['group_id'] = $group_id;
		$params['count'] = true;
		$getGroup = $this->model_group->getGroup($params);
		unset($params['count']);
		if($getGroup == 0){
			echo "Oops. There was something error. Please refresh this page.";
			exit;
		}
			
		$modules = $this->input->post('modules');
		if(strlen($group_name) == 0){
			echo "Please fill the required fields";
			exit;
		}
		$insert_data = array(
			'group_name' => $group_name,
			'group_modification_date' => date('Y-m-d H:i:s'),
			'creator_user_id' => $this->session->userdata('user_id')
		);
		$this->model_group->update($insert_data,$params);
		$this->model_groupmodule->delete(array('group_id'=>$group_id));
		$insert_batch = array();
		if(is_array($modules)){
			$module_input = array();
			foreach($modules as $modulparent => $moduls){
				if(!in_array($modulparent,$module_input)){
					$insert_batch[] = array(
						'group_id'=>$group_id,
						'module_id'=>$modulparent
					);
					$module_input[] = $modulparent;
				}
				foreach($moduls as $modul){
					if(!in_array($modul,$module_input)){
						$insert_batch[] = array(
							'group_id'=>$group_id,
							'module_id'=>$modul
						);
						$module_input[] = $modul;
					}
				}
			}
			$this->model_groupmodule->insert_batch($insert_batch);
		}
		echo "success";
		$this->session->set_flashdata('message',array('message_type'=>'success','message'=>'Designation has been updated'));
	}
	public function security_delete($group_id=""){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/security_rights') ) exit;
		$license_id = $this->session->userdata('license_id');
		
		$params['license_id'] = $license_id;
		$params['group_id'] = $group_id;
		$params['count'] = true;
		$getGroup = $this->model_group->getGroup($params);
		unset($params['count']);
		if($getGroup > 0){
			$this->model_group->update(array('deleted'=>'Y'),$params);
		}
		redirect('security/security_rights');
	}
	public function view_group(){
		$group_id = $this->input->post('group_id');
		if($group_id == '' || $group_id == 'NULL' || !is_moduleAllowed($this->session->userdata('group_id'),'security/security_rights') ){
			echo "failed";
			exit;
		}
		$license_id = $this->session->userdata('license_id');
		$params['license_id'] = $license_id;
		$params['group_id'] = $group_id;
		$params['single'] = true;
		$getGroup = $this->model_group->getGroup($params);
		if(isset($getGroup['group_name']) ){
			$return['group_name'] = $getGroup['group_name'];
			$params2['group_id'] = $getGroup['group_id'];
			$params2['select'][] = 'group_module.module_id';
			$getGroupModule = $this->model_groupmodule->getGroupModule($params2);
			$return['module_list'] = array();
			foreach($getGroupModule as $gm){
				$return['module_list'][] = $gm['module_id'];
			}
			echo json_encode($return);
		}else{
			echo "failed";
		}
	}

	public function department_management($offset=0){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/department_management') ) redirect('home');
		$license_id = $this->session->userdata('license_id');
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Department Management";
		
		$params = array();
		$params['license_id'] = $license_id;
		$embedString = $data['keyword'] = "";
		if($this->input->get('q') ){
			$data['keyword'] = $params['keyword'] = urldecode($this->input->get('q'));
			$embedString = "?q=".$params['keyword'];
		}
		$params['count'] = true;
		$params['join_user'] = true;
		$count = $this->model_department->getDepartment($params);
		//pagination area
		$config = $this->configpagination;
		$config['base_url']       = site_url('security/department_management');
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
		$data['lists'] = $this->model_department->getDepartment($params);
		
		$this->displayView('security/department_management',$data);
	}
	public function add_department(){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/department_management') ) exit;
		$department_name = trim($this->input->post('department_name'));
		$modules = $this->input->post('modules');
		if(strlen($department_name) == 0){
			echo "Please fill the required fields";
			exit;
		}
		$insert_data = array(
			'department_name' => $department_name,
			'department_add_date' => date('Y-m-d H:i:s'),
			'department_modification_date' => date('Y-m-d H:i:s'),
			'license_id' => $this->session->userdata('license_id'),
			'creator_user_id' => $this->session->userdata('user_id')			
		);
		$department_id = $this->model_department->insert($insert_data);
		echo "success";
		$this->session->set_flashdata('message',array('message_type'=>'success','message'=>'New Department has been added'));
	}
	public function edit_department(){
		$department_id = trim($this->input->post('department_id'));
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/department_management') ){
			echo "Sorry, you don't have permission to edit Department";
			exit;
		}
		if($department_id == '' || $department_id == 'NULL'){
			echo "Oops. There was something error. Please refresh this page.";
			exit;
		}
		$department_name = trim($this->input->post('department_name'));
		$license_id = $this->session->userdata('license_id');
		
		$params['license_id'] = $license_id;
		$params['department_id'] = $department_id;
		$params['count'] = true;
		$getDepartment = $this->model_department->getDepartment($params);
		unset($params['count']);
		if($getDepartment == 0){
			echo "Oops. There was something error. Please refresh this page.";
			exit;
		}
			
		$insert_data = array(
			'department_name' => $department_name,
			'department_modification_date' => date('Y-m-d H:i:s'),
			'creator_user_id' => $this->session->userdata('user_id')
		);
		$this->model_department->update($insert_data,$params);
		
		echo "success";
		$this->session->set_flashdata('message',array('message_type'=>'success','message'=>'Department has been updated'));
	}
	public function department_delete($group_id=""){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/department_management') ) exit;
		$license_id = $this->session->userdata('license_id');
		
		$params['license_id'] = $license_id;
		$params['department_id'] = $department_id;
		$params['count'] = true;
		$getDepartment = $this->model_department->getDepartment($params);
		unset($params['count']);
		if($getDepartment > 0){
			$this->model_department->update(array('deleted'=>'Y'),$params);
		}
		redirect('security/department_management');
	}
	public function view_department(){
		$department_id = $this->input->post('department_id');
		if($department_id == '' || $department_id == 'NULL' || !is_moduleAllowed($this->session->userdata('group_id'),'security/department_management') ){
			echo "failed";
			exit;
		}
		$license_id = $this->session->userdata('license_id');
		$params['license_id'] = $license_id;
		$params['department_id'] = $department_id;
		$params['single'] = true;
		$getDepartment = $this->model_department->getDepartment($params);
		if(isset($getDepartment['department_name']) ){
			$return['department_name'] = $getDepartment['department_name'];
			echo json_encode($return);
		}else{
			echo "failed";
		}
	}

	public function qualification_management($offset=0){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/qualification_management') ) redirect('home');
		$license_id = $this->session->userdata('license_id');
		$data['active_module_parent_id'] = $this->parent_module_id;
		$data['web_title'] = "Qualification Management";
		
		$params = array();
		$params['license_id'] = $license_id;
		$embedString = $data['keyword'] = "";
		if($this->input->get('q') ){
			$data['keyword'] = $params['keyword'] = urldecode($this->input->get('q'));
			$embedString = "?q=".$params['keyword'];
		}
		$params['count'] = true;
		$params['join_user'] = true;
		$count = $this->model_qualification->getQualification($params);
		//pagination area
		$config = $this->configpagination;
		$config['base_url']       = site_url('security/qualification_management');
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
		$data['lists'] = $this->model_qualification->getQualification($params);
		
		$this->displayView('security/qualification_management',$data);
	}
	public function add_qualification(){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/qualification_management') ) exit;
		$qualification_name = trim($this->input->post('qualification_name'));
		$modules = $this->input->post('modules');
		if(strlen($qualification_name) == 0){
			echo "Please fill the required fields";
			exit;
		}
		$insert_data = array(
			'qualification_name' => $qualification_name,
			'qualification_add_date' => date('Y-m-d H:i:s'),
			'qualification_modification_date' => date('Y-m-d H:i:s'),
			'license_id' => $this->session->userdata('license_id'),
			'creator_user_id' => $this->session->userdata('user_id')			
		);
		$qualification_id = $this->model_qualification->insert($insert_data);
		echo "success";
		$this->session->set_flashdata('message',array('message_type'=>'success','message'=>'New Qualification has been added'));
	}
	public function edit_qualification(){
		$qualification_id = trim($this->input->post('qualification_id'));
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/qualification_management') ){
			echo "Sorry, you don't have permission to edit Qualification";
			exit;
		}
		if($qualification_id == '' || $qualification_id == 'NULL'){
			echo "Oops. There was something error. Please refresh this page.";
			exit;
		}
		$qualification_name = trim($this->input->post('qualification_name'));
		$license_id = $this->session->userdata('license_id');
		
		$params['license_id'] = $license_id;
		$params['qualification_id'] = $qualification_id;
		$params['count'] = true;
		$getQualification = $this->model_qualification->getQualification($params);
		unset($params['count']);
		if($getQualification == 0){
			echo "Oops. There was something error. Please refresh this page.";
			exit;
		}
			
		$insert_data = array(
			'qualification_name' => $qualification_name,
			'qualification_modification_date' => date('Y-m-d H:i:s'),
			'creator_user_id' => $this->session->userdata('user_id')
		);
		$this->model_qualification->update($insert_data,$params);
		
		echo "success";
		$this->session->set_flashdata('message',array('message_type'=>'success','message'=>'Qualification has been updated'));
	}
	public function qualification_delete($group_id=""){
		if(!is_moduleAllowed($this->session->userdata('group_id'),'security/qualification_management') ) exit;
		$license_id = $this->session->userdata('license_id');
		
		$params['license_id'] = $license_id;
		$params['qualification_id'] = $qualification_id;
		$params['count'] = true;
		$getQualification = $this->model_qualification->getQualification($params);
		unset($params['count']);
		if($getQualification > 0){
			$this->model_qualification->update(array('deleted'=>'Y'),$params);
		}
		redirect('security/qualification_management');
	}
	public function view_qualification(){
		$qualification_id = $this->input->post('qualification_id');
		if($qualification_id == '' || $qualification_id == 'NULL' || !is_moduleAllowed($this->session->userdata('group_id'),'security/qualification_management') ){
			echo "failed";
			exit;
		}
		$license_id = $this->session->userdata('license_id');
		$params['license_id'] = $license_id;
		$params['qualification_id'] = $qualification_id;
		$params['single'] = true;
		$getQualification = $this->model_qualification->getQualification($params);
		if(isset($getQualification['qualification_name']) ){
			$return['qualification_name'] = $getQualification['qualification_name'];
			echo json_encode($return);
		}else{
			echo "failed";
		}
	}

}
