<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$roles = $this->session->userdata('roles');
		if($roles != "backend") redirect('home');
		$this->load->model('model_module');
		$this->load->model('model_user');
		$this->load->model('model_license');
		$this->load->model('model_group');
		$this->load->model('model_groupmodule');
	} 
	public function index(){
		redirect('admin/institute_list');
	}
	public function institute_list($offset=0){
		$data['web_title'] = "Institute List";
		$params = array();
		$embedString = "";
		$data['keyword'] = '';
		if($this->input->get('q') ){
			$data['keyword'] = $params['keyword'] = urldecode($this->input->get('q'));
			$embedString = "?q=".$params['keyword'];
		}
		$params['count'] = true;
		$count = $this->model_license->getLicense($params);
		//pagination area
		$config = $this->configpagination;
		$config['base_url']       = site_url('admin/institute_list');
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
		$data['lists'] = $this->model_license->getLicense($params);
		$this->displayView('admin/institute_list',$data);
	}
	public function new_institute(){
		if($this->input->post()){
			$school = $this->input->post('school');
			$users = $this->input->post('users');
			$modules = $this->input->post('modules');
			if(strlen(trim($school['school_name'])) == 0 || strlen(trim($users['username'])) < 5 || strlen(trim($users['password'])) < 5 || strlen(trim($users['name'])) == 0){
				$data['message_type'] = 'danger';
				$data['message'] = 'Please fill all mandatory fields. Username and password must be at least 5 characters';
			}else{
				// check for username duplication
				$getUser = $this->model_user->getUser(array('username'=>$users['username'],'count'=>true));
				if($getUser > 0){
					$data['message_type'] = 'danger';
					$data['message'] = 'Username already exist. Please choose another username';
				}else{
					if($school['license_expired_date'] != '') $school['license_expired_date'] = convert_date_by_timezone($school['license_expired_date']);
					$school['license_date'] = date('Y-m-d H:i:s');
					$license_id = $this->model_license->insert($school);
					$insert_group = array(
							'group_name' => 'Super Admin',
							'group_add_date' => date('Y-m-d H:i:s'),
							'group_modification_date' => date('Y-m-d H:i:s'),
							'license_id' => $license_id,
							'creator_user_id' => $this->session->userdata('user_id')
						);
					$group_id = $this->model_group->insert($insert_group);
					$users['group_id'] = $group_id;
					$users['license_id'] = $license_id;
					$users['roles'] = 'license_owner';
					$users['created_date'] = date('Y-m-d H:i:s');
					$users['registered_by'] = $this->session->userdata('user_id');
					$users['password'] = Auth::encryptPassword($users['password']);
					$user_id = $this->model_user->insert($users);
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
					$data['message_type'] = 'success';
					$data['message'] = 'Institute has been added';
				}
			}
		}
		$data['web_title'] = "Institute Registration";
		$data['total_all_modules'] = $this->model_module->getModule(array('count'=>true));
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
		$this->displayView('admin/new_institute',$data);
	}

	public function institute_detail($license_id=''){
		if($license_id == '') redirect('admin/institute_list');
		$data['web_title'] = "Institute Detail";
		$data['total_all_modules'] = $this->model_module->getModule(array('count'=>true));
		$params['license_id'] = $license_id;
		$params['single'] = true;
		$data['getLicense'] = $this->model_license->getLicense($params);
		if(count($data['getLicense']) == 0) redirect('admin/school_list');
		
		if($this->input->post()){
			$school = $this->input->post('school');
			$users = $this->input->post('users');
			$modules = $this->input->post('modules');
			$passwordchange = false;
			if(strlen(trim($users['password'])) > 0) $passwordchange = true;
			if(strlen(trim($school['school_name'])) == 0 || ($passwordchange && strlen(trim($users['password'])) < 5) || strlen(trim($users['name'])) == 0){
				$data['message_type'] = 'danger';
				$data['message'] = 'Please fill all mandatory fields. Username and password must be at least 5 characters';
			}else{
				if($school['license_expired_date'] != '') $school['license_expired_date'] = convert_date_by_timezone($school['license_expired_date']);
				$this->model_license->update($school,array('license_id'=>$license_id));
				$params['creator_user_id'] = $this->session->userdata('user_id');
				
				if($passwordchange){
					$users['password'] = Auth::encryptPassword($users['password']);
				}else{
					unset($users['password']);
				}
				$this->model_user->update($users,array('roles'=>'license_owner'));
				$getGroup = $this->model_group->getGroup($params);
				$group_id = $getGroup['group_id'];
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
				$data['message_type'] = 'success';
				$data['message'] = 'Institute has been updated';
			}
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
		$params['roles'] = 'license_owner';
		$data['getUser'] = $this->model_user->getUser($params);
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
		$this->displayView('admin/institute_detail',$data);
	}
	public function institute_delete($license_id=''){
		if($license_id != ''){
			$params['license_id'] = $license_id;
			$this->model_license->update(array('status'=>'deleted'),$params);
			$this->model_group->update(array('deleted'=>'Y'),$params);
			$this->model_user->update(array('deleted'=>'Y'),$params);
		}
		redirect('admin/institute_list');
	}
	
}
