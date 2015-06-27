<?php
if(!function_exists('embedSuffixInPaging')) {
	function embedSuffixInPaging($embedString, $pagination) { //to manipulate pagination link to embed the suffix needed
		$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		$unique = array();
		if(preg_match_all("/$regexp/siU", $pagination, $matches)) {
			foreach($matches[2] as $link) {
				if(!isset($unique[$link])) {
					$pagination    = str_replace($link . '"', $link . $embedString . '"', $pagination);
					$unique[$link] = '';
				}
			}
		}
		unset($unique);
		return $pagination;
	}
}
if(!function_exists('rand_string')) {
	function rand_string($l){ 
		$s= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
		srand((double)microtime()*1000000); 
		for($i=0; $i<$l; $i++) { 
			$rand.= $s[rand()%strlen($s)]; 
		} 
		return $rand; 
	}
}
if(!function_exists('numberToPlace')) {
	function numberToPlace($number) {
		if(!is_numeric($number)) return false;
		$number = intval($number);
		$lastNumber = substr($number, -1);
		$lastTwo = substr($number, -2);
		$append = ($lastNumber == '1' && $lastTwo != 11) ? 'st' : (($lastNumber == '2' && $lastTwo != 12) ? 'nd' : (($lastNumber == '3' && $lastTwo != 13) ? 'rd' : 'th'));
		return $number . $append;
	}
}
if(!function_exists('createdir')) {
	function createdir($dir){
		if (!is_dir($dir)) {
			$old = umask(0);
			mkdir($dir, 0777, TRUE);
			umask($old);
		}
	}
}
if(!function_exists('fetchUrl')) {	
	function fetchUrl($url,$post=array()){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt ($curl, CURLOPT_POST, TRUE);
		curl_setopt ($curl, CURLOPT_POSTFIELDS, $post); 

		curl_setopt($curl, CURLOPT_USERAGENT, 'api');
		curl_setopt($curl, CURLOPT_TIMEOUT, 1);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl,  CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 10); 

		curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);

		curl_exec($curl); 
		curl_close($curl);  	
	}
}
if(!function_exists('convert_date_by_timezone')) {
	function convert_date_by_timezone($date){ //convert to server time
		$the_date         = strtotime($date);
		$ci = &get_instance();
		if($ci->session->userdata('usertimezoneoffset') != ''){
			$current_timezone = date_default_timezone_get();
			$dateTimeZone_ori = new DateTimeZone($current_timezone);
			$dateTimeOri = new DateTime("now", $dateTimeZone_ori);
			$timeOffset = $dateTimeOri->getOffset() / 60; // offset time now to UTC in minutes 420
			$usertimezoneoffset = $ci->session->userdata('usertimezoneoffset'); //480 -60
			$offset_min_to_server = ($timeOffset - $usertimezoneoffset) * 60; // second
			$timeprocess = $the_date + $offset_min_to_server;
		}else{
			$timeprocess = $the_date;
		}
		$display_date = date('Y-m-d',$timeprocess);
		$display_time = date('H:i:s',$timeprocess);
		if($display_time == "00:00:00") $display_time = date("H:i:s");
		return $display_date . " ".$display_time;
	}
}
if(!function_exists('display_date_by_timezone')) {
	function display_date_by_timezone($date='', $display_date=true, $display_time=true,$custom_format='') {
		if($date == '0000-00-00 00:00:00') return '';
		if($date == '') $date = date('Y-m-d H:i:s');
		$format = "n/j/Y h:i A";
		if($custom_format != ''){
			$format = $custom_format;
		}else{
			if($display_date && $display_time) {
				$format = "n/j/Y h:i A";
			}else if($display_date){
				$format = "n/j/Y";
			}else if($display_time) $format = "h:i A";
		}
		$the_date         = strtotime($date);
		if($the_date == '') return '';
		
		$ci = &get_instance();
		if($ci->session->userdata('usertimezoneoffset') != ''){
			$current_timezone = date_default_timezone_get();
			$dateTimeZone_ori = new DateTimeZone($current_timezone);
			
			$dateTimeOri = new DateTime("now", $dateTimeZone_ori);
			
			$timeOffset = $dateTimeOri->getOffset() / 60; // offset time now to UTC in minutes 420
			$usertimezoneoffset = $ci->session->userdata('usertimezoneoffset'); //480 +60
			$offset_min_to_server = ($usertimezoneoffset - $timeOffset) * 60; // second
			
			$the_date = $the_date + $offset_min_to_server;
		}
		$return = date($format,$the_date);
		return $return;
	}
}
if(!function_exists('display_date')) {
	function display_date($date='', $display_date=true, $display_time=true,$custom_format='') {
		if($date == '0000-00-00 00:00:00') return '';
		if($date == '') $date = date('Y-m-d H:i:s');
		$format = "n/j/Y h:i A";
		if($custom_format != ''){
			$format = $custom_format;
		}else{
			if($display_date && $display_time) {
				$format = "n/j/Y h:i A";
			}else if($display_date){
				$format = "n/j/Y";
			}else if($display_time) $format = "h:i A";
		}
		$the_date         = strtotime($date);
		if($the_date == '') return '';
		$return = date($format,$the_date);
		return $return;
	}
}
if(!function_exists('get_scriptlocation')) {
	function get_scriptlocation() {
		$scriptlocation = '';
		$scriptlocation_exp = explode('/',$_SERVER['SCRIPT_FILENAME']);
		for($i=0;$i < count($scriptlocation_exp)-1; $i++){
			$scriptlocation .= $scriptlocation_exp[$i].'/';
		}
		return $scriptlocation;
	}
}
if(!function_exists('run_cli')) {
	function run_cli($path,$prefix='') {
		$scriptlocation = get_scriptlocation();
		$path = $scriptlocation.'index.php '.$path;
		if($prefix != '') $prefix = trim($prefix) .' ';
		exec($prefix.'php '.$path);
	}
}
if(!function_exists('is_date')) {
	function is_date($str){
		if (is_numeric($str)) return FALSE;
		$stamp = strtotime($str); 
		if (!is_numeric($stamp)) return FALSE; 
		$month = date('m', $stamp);
		$day   = date('d', $stamp);
		$year  = date('Y', $stamp);
		if (checkdate($month, $day, $year)) return TRUE; 
		return FALSE; 
	}
}
if(!function_exists('objectToArray')) {
	function objectToArray($object){
		if(!is_object($object) && !is_array($object)) return $object;

		$array=array();
		foreach($object as $member=>$data){
			$array[$member]=objectToArray($data);
		}
		return $array;
	}
}
if(!function_exists('removedir')) {
	function removedir($dirname){
		$filename = "$dirname";
		if (is_readable($filename)) {
			$dir = "$dirname/";
			// open specified directory and remove all files within
			$dirHandle = opendir($dir);
			while ($file = readdir($dirHandle)) {
				if(!is_dir($file)) {
					unlink($dir.$file);
				}
			}
			closedir($dirHandle);
			//remove dir at the end
			rmdir($dir);
		}
	}
}
if(!function_exists('format_interval')) {
	function format_interval($timestamp, $granularity = 2) {
		$units = array('1 year|@count years' => 31536000, '1 week|@count weeks' => 604800, '1 day|@count days' => 86400, '1 hour|@count hours' => 3600, '1 min|@count min' => 60, '1 sec|@count sec' => 1);
		$output = '';
		foreach ($units as $key => $value) {
			$key = explode('|', $key);
			if ($timestamp >= $value) {
				$floor = floor($timestamp / $value);
				$output .= ($output ? ' ' : '') . ($floor == 1 ? $key[0] : str_replace('@count', $floor, $key[1]));
				$timestamp %= $value;
				$granularity--;
			}

			if ($granularity == 0) {
				break;
			}
		}

		return $output ? $output : '0 sec';
	}
}

if(!function_exists('getslug')) {
	function getslug($value,$field,$table){
		$ci = & get_instance();
		$val = url_title($value);
		$count = $ci->db->select()->from($table)->where($field,$val)->get()->num_rows();
		if($count > 0) $val = $val."-".$count;
		return $val;
	}
}
if(!function_exists('generateUniqueID')) {
	function generateUniqueID($table,$field,$length = 15) {
		$ci = & get_instance();
		$random = "";
		$data   = "0123456789";
		for($i = 0; $i < $length; $i++) {
			$random .= substr($data, (mt_rand(1, strlen($data))), 1);
		}
		$result = $ci->db->get_where($table, array(
			$field => $random
		), 1);
		if($result->num_rows() > 0) {
			return generateClientID($table,$field,$length);
		}
		return $random;
	}
}
