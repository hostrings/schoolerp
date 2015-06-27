<?php
class Model_salaryhistory extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getSalaryhistory($params=array()){
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
			$this->db->select("salaryhistory.*");
		}
		$this->db->from("salaryhistory");
		if(isset($params['join_user']) ){
			$this->db->join('users','salaryhistory.user_id=users.user_id');
			$this->db->select("users.username");
			$this->db->select("users.name");
		}
		if(isset($params['salaryhistory_id']) ) $this->db->where('salaryhistory_id',$params['salaryhistory_id']);
		if(isset($params['user_id']) ) $this->db->where('user_id',$params['user_id']);
		if(isset($params['input_by_user_id']) ) $this->db->where('input_by_user_id',$params['input_by_user_id']);
		if(isset($params['license_id']) ) $this->db->where('salaryhistory.license_id',$params['license_id']);
		if(isset($params['keyword']) ){
			$field = array('salary');
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
		if(!isset($params['order_by']) ) $params['order_by'] = 'input_date desc';
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
		$insert_data['salaryhistory_id'] = generateUniqueID('salaryhistory','salaryhistory_id');
		$this->db->insert('salaryhistory',$insert_data);
		return $insert_data['salaryhistory_id'];
	}
	
	public function update($insert_data,$params=array()){
		if(isset($params['salaryhistory_id']) ) $this->db->where('salaryhistory_id',$params['salaryhistory_id']);
		if(isset($params['user_id']) ) $this->db->where('user_id',$params['user_id']);
		if(isset($params['license_id']) ) $this->db->where('license_id',$params['license_id']);
		if(isset($params['input_by_user_id']) ) $this->db->where('input_by_user_id',$params['input_by_user_id']);
		$this->db->update('salaryhistory', $insert_data);
	}	
}