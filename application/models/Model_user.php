<?php
class Model_user extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getUser($params=array()){
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
		$this->db->from("users");
		$this->db->where('deleted','N');
		if(isset($params['user_id']) ) $this->db->where('user_id',$params['user_id']);
		if(isset($params['roles']) ) $this->db->where('roles',$params['roles']);
		if(isset($params['license_id']) ) $this->db->where('license_id',$params['license_id']);
		if(isset($params['group_id']) ) $this->db->where('group_id',$params['group_id']);
		if(isset($params['department_id']) ) $this->db->where('department_id',$params['department_id']);
		if(isset($params['qualification_id']) ) $this->db->where('qualification_id',$params['qualification_id']);
		if(isset($params['username']) ) $this->db->where('username',$params['username']);
		if(isset($params['employeement_status']) ) $this->db->where('employeement_status',$params['employeement_status']);
		if(isset($params['email']) ) $this->db->where('email',$params['email']);
		if(isset($params['created_date_start']) ) $this->db->where('created_date >=',$params['created_date_start']);
		if(isset($params['created_date_end']) ) $this->db->where('created_date >=',$params['created_date_end']);
		if(isset($params['keyword']) ){
			$field = array('name','email');
			$where = "";
			foreach($field as $val){
				if($where != "") $where .= " or ";
				$where .= $val ." LIKE '%".$params['keyword']."%'";
				
			}
			if($where != ""){
				$where = "(".$where.")";
				$this->db->where($where,null,false);
			}
		}
		if(!isset($params['order_by']) ) $params['order_by'] = 'name asc';
		$this->db->order_by($params['order_by']);
		if(isset($params['limit']) && isset($params['offset']) ) $this->db->limit($params['limit'],$params['offset']);
		if(isset($params['count']) ){
			$return = $this->db->count_all_results();
		}else if(isset($params['single']) ){
			$query = $this->db->get();
			$return = $query->row_array();
		}else{
			$query = $this->db->get();
			$return = $query->result_array();
		}
		return $return;
	}
	
	public function insert($insert_data) {
		$insert_data['user_id'] = generateUniqueID('users','user_id');
		$this->db->insert('users',$insert_data);
		return $insert_data['user_id'];
	}
	
	public function update($insert_data,$params=array()){
		if(isset($params['user_id']) ) $this->db->where('user_id',$params['user_id']);
		if(isset($params['roles']) ) $this->db->where('roles',$params['roles']);
		if(isset($params['license_id']) ) $this->db->where('license_id',$params['license_id']);
		if(isset($params['group_id']) ) $this->db->where('group_id',$params['group_id']);
		if(isset($params['username']) ) $this->db->where('username',$params['username']);
		if(isset($params['email']) ) $user->where('email',$params['email']);
		$this->db->update('users', $insert_data);
		
		$havesetmethod = false;
		if(isset($insert_data['time_from']) ){
			if($insert_data['time_from'] == 'NULL'){
				unset($insert_data['time_from']);
				$this->db->set('time_from', NULL);
				$havesetmethod = true;
			}
		}
		if(isset($insert_data['time_to']) ){
			if($insert_data['time_to'] == 'NULL'){
				unset($insert_data['time_to']);
				$this->db->set('time_to', NULL);
				$havesetmethod = true;
			}
		}
		if($havesetmethod){
			if(isset($params['user_id']) ) $this->db->where('user_id',$params['user_id']);
			if(isset($params['roles']) ) $this->db->where('roles',$params['roles']);
			if(isset($params['license_id']) ) $this->db->where('license_id',$params['license_id']);
			if(isset($params['group_id']) ) $this->db->where('group_id',$params['group_id']);
			if(isset($params['username']) ) $this->db->where('username',$params['username']);
			if(isset($params['email']) ) $user->where('email',$params['email']);
			$this->db->update('users');
		}
	}	
}