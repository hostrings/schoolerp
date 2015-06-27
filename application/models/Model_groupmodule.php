<?php
class Model_groupmodule extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getGroupModule($params=array()){
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
		$this->db->from("group_module");
		$this->db->join('modules','group_module.module_id=modules.module_id');
		if(isset($params['join_group']) ) $this->db->join('group','group_module.group_id=group.group_id');
		if(isset($params['group_id']) ) $this->db->where('group_module.group_id',$params['group_id']);
		if(isset($params['module_id']) ) $this->db->where('group_module.module_id',$params['module_id']);
		if(isset($params['module_parent_id']) ) $this->db->where('modules.module_parent_id',$params['module_parent_id']);
		if(isset($params['module_display']) ) $this->db->where('modules.module_display',$params['module_display']);
		if(isset($params['module_link']) ) $this->db->where('modules.module_link',$params['module_link']);
		
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
	
	public function insert_batch($insert_data) {
		$this->db->insert_batch('group_module',$insert_data);
	}
	
	public function update($insert_data,$params=array()){
		if(isset($params['group_id']) ) $this->db->where('group_id',$params['group_id']);
		if(isset($params['module_id']) ) $this->db->where('module_id',$params['module_id']);
		if(isset($params['module_parent_id']) ) $this->db->where('module_parent_id',$params['module_parent_id']);
		$this->db->update('group_module', $insert_data);
	}
	public function delete($params=array()){
		if(isset($params['group_id']) ) $this->db->where('group_id',$params['group_id']);
		if(isset($params['module_id']) ) $this->db->where('module_id',$params['module_id']);
		if(isset($params['module_parent_id']) ) $this->db->where('module_parent_id',$params['module_parent_id']);
		$this->db->delete('group_module');
	}
}