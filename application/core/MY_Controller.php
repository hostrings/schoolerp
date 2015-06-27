<?php
class MY_Controller extends CI_Controller{
	var $configpagination;
	var $per_page = 12;
	function __construct(){
		parent::__construct();
		//pagination area
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '<i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i>';
		$config['first_tag_open'] = '<li class="prev">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>';
		$config['last_tag_open'] = '<li class="next">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void()">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->configpagination = $config;
		unset($config);
		
		if(!Auth::isLoggedIn()) redirect('login');
	}
	function displayView($viewname,$data=array()){
		if(!isset($data['active_module_parent_id']) ) $data['active_module_parent_id'] = '';
		$this->load->view('general/header',$data);
		$this->load->view($viewname,$data);
		$this->load->view('general/footer',$data);
	}
}