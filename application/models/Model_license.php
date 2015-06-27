<?php
class Model_license extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getLicense($params=array()){
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
		$this->db->from("license");
		$this->db->where('status !=','deleted');
		if(isset($params['license_id']) ) $this->db->where('license_id',$params['license_id']);
		if(isset($params['status']) ) $this->db->where('status',$params['status']);
		if(isset($params['keyword']) ){
			$field = array('school_name');
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
		if(!isset($params['order_by']) ) $params['order_by'] = 'school_name asc';
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
		$insert_data['license_id'] = generateUniqueID('license','license_id');
		$this->db->insert('license',$insert_data);
		return $insert_data['license_id'];
	}
	
	public function update($insert_data,$params=array()){
		if(isset($params['license_id']) ) $this->db->where('license_id',$params['license_id']);
		if(isset($params['status']) ) $this->db->where('status',$params['status']);
		$this->db->update('license', $insert_data);
	}	
}