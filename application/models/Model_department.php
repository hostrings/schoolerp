<?php
class Model_department extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getDepartment($params=array()){
		if(isset($params['select'])) {
			foreach($params['select'] as $select) {
				if(is_array($select)) {
					foreach($select as $sel)
						$this->db->select($sel, false);
				} else {
					$this->db->select($select, false);
				}
			}
		}else{
			$this->db->select("department.*");
		}
		$this->db->from("department");
		$this->db->where('department.deleted','N');
		if(isset($params['join_user']) ){
			$this->db->join('users','department.creator_user_id=users.user_id');
			$this->db->select("users.username");
			$this->db->select("users.name");
		}
		if(isset($params['department_id']) ) $this->db->where('department_id',$params['department_id']);
		if(isset($params['creator_user_id']) ) $this->db->where('creator_user_id',$params['creator_user_id']);
		if(isset($params['license_id']) ) $this->db->where('department.license_id',$params['license_id']);
		if(isset($params['keyword']) ){
			$field = array('department_name');
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
		if(!isset($params['order_by']) ) $params['order_by'] = 'department_name asc';
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
		$insert_data['department_id'] = generateUniqueID('department','department_id');
		$this->db->insert('department',$insert_data);
		return $insert_data['department_id'];
	}
	
	public function update($insert_data,$params=array()){
		if(isset($params['department_id']) ) $this->db->where('department_id',$params['department_id']);
		if(isset($params['creator_user_id']) ) $this->db->where('creator_user_id',$params['creator_user_id']);
		if(isset($params['license_id']) ) $this->db->where('license_id',$params['license_id']);
		$this->db->update('department', $insert_data);
	}	
}