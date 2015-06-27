<?php
function get_group_module($group_id,$module_parent_id='',$module_display=''){
	$ci = & get_instance();
	$ci->load->model("model_groupmodule");
	$params = array('group_id'=>$group_id);
	if($module_parent_id != '') $params['module_parent_id'] = $module_parent_id;
	if($module_display != '') $params['module_display'] = $module_display;
	$getGroupModule = $ci->model_groupmodule->getGroupModule($params);
	return $getGroupModule;
}
function is_moduleAllowed($group_id,$module_id,$find_child=false){
	if($group_id == 0){
		return true;
	}else{
		$ci = & get_instance();
		$ci->load->model("model_groupmodule");
		$params = array('group_id'=>$group_id);
		if($find_child){
			$params['single'] = true;
		}else{
			$params['count'] = true;
		}
		if(!is_numeric($module_id) != ''){
			$params['module_link'] = $module_id;
		}else{
			$params['module_id'] = $module_id;
		}
		$getGroupModule = $ci->model_groupmodule->getGroupModule($params);
		if($find_child){
			if(count($getGroupModule) == 0){
				return false;
			}else{
				$params2['parent_module_id'] = $getGroupModule['module_id'];
				$params2['count'] = true;
				$getGroupModule = $ci->model_groupmodule->getGroupModule($params2);
			}
		}
		if($getGroupModule == 0){
			return false;
		}else{
			return true;
		}
	}
}
function get_total_group_member($group_id){
	$ci = & get_instance();
	$ci->load->model("model_user");
	$getUser = $ci->model_user->getUser(array('group_id'=>$group_id,'count'=>true));
	return number_format($getUser);
}
function get_group_member($group_id){
	$ci = & get_instance();
	$ci->load->model("model_user");
	$getUser = $ci->model_user->getUser(array('group_id'=>$group_id));
	return $getUser;
}
function get_group_name($group_id){
	$ci = & get_instance();
	$ci->load->model("model_group");
	$getGroup = $ci->model_group->getGroup(array('group_id'=>$group_id,'single'=>true));
	$return = "";
	if(isset($getGroup['group_name']) ) $return = $getGroup['group_name'];
	return $return;
}
function get_total_department_member($department_id){
	$ci = & get_instance();
	$ci->load->model("model_user");
	$getUser = $ci->model_user->getUser(array('department_id'=>$department_id,'count'=>true));
	return number_format($getUser);
}
function get_department_name($department_id){
	$ci = & get_instance();
	$ci->load->model("model_department");
	$getDepartment = $ci->model_department->getDepartment(array('department_id'=>$department_id,'single'=>true));
	$return = "";
	if(isset($getDepartment['department_name']) ) $return = $getDepartment['department_name'];
	return $return;
}
function get_total_qualification_member($qualification_id){
	$ci = & get_instance();
	$ci->load->model("model_user");
	$getUser = $ci->model_user->getUser(array('qualification_id'=>$qualification_id,'count'=>true));
	return number_format($getUser);
}
function get_qualification_name($qualification_id){
	$ci = & get_instance();
	$ci->load->model("model_qualification");
	$getQualification = $ci->model_qualification->getQualification(array('qualification_id'=>$qualification_id,'single'=>true));
	$return = "";
	if(isset($getQualification['qualification_name']) ) $return = $getQualification['qualification_name'];
	return $return;
}