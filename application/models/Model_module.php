<?php
class Model_module extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getModule($params=array()){
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
		$this->db->from("modules");
		if(isset($params['module_id']) ) $this->db->where('module_id',$params['module_id']);
		if(isset($params['module_parent_id']) ) $this->db->where('module_parent_id',$params['module_parent_id']);
		if(isset($params['keyword']) ){
			$field = array('module_name');
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
		if(!isset($params['order_by']) ) $params['order_by'] = 'module_display_sequence asc';
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
		$this->db->insert('modules',$insert_data);
		return $this->db->insert_id();
	}
	
	public function update($insert_data,$params=array()){
		if(isset($params['module_id']) ) $this->db->where('module_id',$params['module_id']);
		if(isset($params['module_parent_id']) ) $this->db->where('module_parent_id',$params['module_parent_id']);
		$this->db->update('modules', $insert_data);
	}	
}