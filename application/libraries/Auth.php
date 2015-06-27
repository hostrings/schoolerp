<?php
class Auth{
	public static function getLoggedInUserName(){
		$ci = & get_instance();
		$ci->load->model("model_user");
		$user = $ci->model_user;
		$data = $user->getUser(array('user_id'=>$ci->session->userdata('user_id'),'single'=>true));
		if(isset($data['name']) ) return $data['name'];
		return "Guest";
	}
	public static function encryptPassword($plainText, $salt = null) {
		if ($salt === null) {
			$salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
		} else {
			$salt = substr($salt, 0, SALT_LENGTH); 
		}		
		return $salt . sha1($salt . $plainText);
	}
	public static function isLoggedIn() { //cek user sudah login atau belum
		$ci = & get_instance();
		$session = $ci->session->userdata('user_id');
		if($session != ''){
			return true;
		}
		return false;
	}
	public static function getpass($password,$password_db){
		return Auth::encryptPassword($password,substr($password_db, 0, SALT_LENGTH));
	}
	public static function logout(){ //logout
		$ci = & get_instance();
		$ci->session->unset_userdata('user_id');
		$ci->session->unset_userdata('group_id');
		$ci->session->unset_userdata('roles');
		$ci->session->unset_userdata('name');
		$ci->session->unset_userdata('license_id');
		$ci->session->sess_destroy();
	}
	public static function login($username,$password){ //login
		$ci = & get_instance();
		$ci->load->model("model_user");
		$ci->load->model("model_license");
		$user = $ci->model_user;
		$data = $user->getUser(array('username'=>$username,'single'=>true,'employeement_status'=>'active'));
		if(!isset($data['user_id'])){
			$return['type'] = false;
			$return['message'] = "Your username or password is incorrect.";
			return $return;
		}else{
			$get_pass = Auth::getpass($password,$data['password']);
			if($get_pass == $data['password']){
				if($data['roles'] == 'backend'){
					$ci->session->set_userdata('user_id', $data['user_id']);
					$ci->session->set_userdata('user_employee_photo', $data['user_employee_photo']);
					$ci->session->set_userdata('group_id', $data['group_id']);
					$ci->session->set_userdata('roles', $data['roles']);
					$ci->session->set_userdata('name', $data['name']);
					$ci->session->set_userdata('license_id', $data['license_id']);
					$user->update(array('last_login'=>date("Y-m-d H:i:s")),array('user_id'=>$data['user_id']));
					$return['type'] = true;
					return $return;
				}
				//check if license is not deleted
				$license = $ci->model_license;
				$datalicense = $license->getLicense(array('license_id'=>$data['license_id'],'single'=>true));
				if(count($datalicense) > 0){
					if(strtotime($datalicense['license_expired_date']) > time() || $datalicense['license_expired_date'] == '0000-00-00 00:00:00'){
						$ci->session->set_userdata('user_id', $data['user_id']);
						$ci->session->set_userdata('user_employee_photo', $data['user_employee_photo']);
						$ci->session->set_userdata('group_id', $data['group_id']);
						$ci->session->set_userdata('roles', $data['roles']);
						$ci->session->set_userdata('name', $data['name']);
						$ci->session->set_userdata('license_id', $data['license_id']);
						$user->update(array('last_login'=>date("Y-m-d H:i:s")),array('user_id'=>$data['user_id']));
						$return['type'] = true;
						return $return;
					}else{
						$return['type'] = false;
						$return['message'] = "Your license has expired. Please contact administrator for support.";
						return $return;
					}
				}else{
					$return['type'] = false;
					$return['message'] = "Your username or password is incorrect.";
					return $return;
				}
			}
			$return['type'] = false;
			$return['message'] = "Your username or password is incorrect.";
			return $return;
		}
	}
}