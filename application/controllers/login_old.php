<?php
class Login extends CI_Controller {
 
function __construct()
{
   parent::__construct();
}
 
function index()
{
   		$this->load->helper(array('form'));
   		$data = array();
		$CI =& get_instance();
     //Field validation failed.  User redirected to login page
     		$session_data = $this->session->userdata('logged_in');
	    	$data['username'] = $session_data['username'];
	    	$data['menu'] = $CI->db->get('menu');
		$data['submenu'] = $CI->db->get('submenu');
		$this->load->view('header', $data);
		$this->load->view('login_view', $data);
		$this->load->view('footer', $data);
}
 
}
 
?>