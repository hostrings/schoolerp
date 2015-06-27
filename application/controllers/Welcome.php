<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.	
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
	} 
	public function index()
	{
		$data = array();
		$CI =& get_instance();
		if($CI->session->userdata('logged_in'))
		{
		    	$session_data = $CI->session->userdata('logged_in');
		     	$data['username'] = $session_data['username'];
			$data['menu'] = $CI->db->get('menu');
			$data['submenu'] = $CI->db->get('submenu');
			$this->load->view('header', $data);
			$this->load->view('welcome_message', $data);
			$this->load->view('footer', $data);
		}
		else
		{
		     //If no session, redirect to login page
		     redirect('welcome/admin', 'refresh');
	   	}
		
	}
	public function admin()
	{
		$data = array();
		$CI =& get_instance();
		$data['menu'] = $CI->db->get('menu');
		$data['submenu'] = $CI->db->get('submenu');
		$this->load->view('header', $data);
		$this->load->view('admin', $data);
		$this->load->view('footer', $data);
	}
	public function category()
	{
		$menu_id = $this->uri->segment(3);
		$data = array();
		$CI =& get_instance();
		$data['menu'] = $CI->db->get('menu');
		$data['submenu'] = $CI->db->get('submenu');
		$this->load->view('header', $data);
		if($menu_id == 1)
		{
			$this->load->view('students', $data);
		}
		$this->load->view('footer', $data);
	}
	public function login()
	{
	   if($this->session->userdata('logged_in'))
	   {
	     $session_data = $this->session->userdata('logged_in');
	     $data['username'] = $session_data['username'];
	     $data['menu'] = $CI->db->get('menu');
		$data['submenu'] = $CI->db->get('submenu');
		$this->load->view('header', $data);
		$this->load->view('login_view', $data);
		$this->load->view('footer', $data);
	   }
	   else
	   {
	     redirect('welcome/admin', 'refresh');
	   }
	}
 
	public function logout()
	{
	   $this->session->unset_userdata('logged_in');
	   session_destroy( );
	   redirect('welcome/admin', 'refresh');
	}
	public function change_admin()
	{
		$data = array();
		$CI =& get_instance();
		$state = $CI->input->post( 'state' );
		$query = $CI->db->query('SELECT * FROM menu WHERE name="'.addslashes($state).'"');
		$data = $query->result_array();
		echo json_encode($data);   
	}
}
