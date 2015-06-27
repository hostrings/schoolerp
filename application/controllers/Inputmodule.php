<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inputmodule extends CI_Controller {

	public function __construct(){
		parent::__construct();
	} 
	public function index(){
		$parent = "Student;
		Examination;
		Employee;
		Teacher Appraisal;
		Fee;
		Accounts;
		Inventory;
		Reports;
		Configuration;
		Utilities;
		Security;";
		$data['Security']['default'] = "security rights;department management;qualification management;Institute Information;";
		$data['Utilities']['default'] = "backup database;
student import attendence;
employee import attendance;
import students excel data;
event;
event type;
event sms utility;
staff sms utility;";
		$data['Configuration']['default'] = "class;
section;
subject;
time table;
new terminal;
branch information;
email configuration;
event sms configuration;
connect to mobile;
sms template;
sms sent log;
activity log;";
		$data['Reports']['Inventory Report'] = "purchase report;
purchase order report;
sales order report;
sales report;
sales return report;
stock report;";
		$data['Reports']['Examination Report'] = "Term progress report;
progress detail report;
student wise test report;
round report;
paper maker reports;";
		$data['Reports']['Accounts Report'] = "expense detail report;
payment detail report;";
		$data['Reports']['Fee Report'] = "Fee Collection Report;
Advance Fee Report;";
		$data['Reports']['Employee Report'] = "Attendance Report;
left teacher report;";
		$data['Reports']['Student Report'] = "Attedance Detail Report;
Daily attandence report;
student comparison report;
student age report;
sibling strength report;";
		$data['Reports']['default'] = "Student Report;
Employee Report;
Fee Report;
Accounts Report;
Examination Report;
Inventory Report;";
		$data['Inventory']['default'] = "Inventory item;
inventory configuration;
define location;
define item group;
define item type;
define item gender;
define item unit;
sales order;
sales;
sales return;
purchase order;
purchase;
purchase return;
stock statement;";
		$data['Accounts']['default'] = "Main account;
Detail Account;
Voucher Entry;
Receipts; 
Payment;
Expenses;
Chart of Account;
Ledger;
Trial Balance;
Profit and loss;
balance sheet;
student wise income;
cash flow statement;";
		$data['Fee']['default'] = "Fee Package List;
Generate Fee Package;
Print Fee Voucher;
Collection;
Fee Payment Slip;
Defaulter List;
Fee concession;
Course Fee;";
		$data['Teacher Appraisal']['default'] = "Subject Results;
Classroom Observation;
Copy Checking;
Professional Traits;
Professional Development;
Regularity;
Punctuality;
Feedback;";
		$data['Employee']['Employee List'] = "Employee Attendance;
Employee Salary;
Employee Bar Code Print;
teacher experience award sheet;";
		$data['Employee']['class subjects and teachers'] = "Employee Attendance;
Employee Salary;
Employee Bar Code Print;
teacher experience award sheet;";
		$data['Employee']['default'] = "Employee Registration;
Employee List;
Section wise incharge info;
class subjects and teachers;";
		$data['Examination']['default'] = "Session;
Term;
Subject Evaluation;
examination type;
date sheet;
result card;
student result;
student subject wise result;
add new round;
test system;
test report;
award list;
paper setter;
paper maker;";
		$data['Student']['Student List'] = "student bar code print;
Scan Bar Code Card Attendance;
Attendance;
contact info;
student promotions;
student left summary;
student strength;
area wise strength;
character certificate;
leaving certificate;";
		$data['Student']['default'] = "Student Registration;
Student List;
admission form;
student leaving form;";

		$parent_explode = explode(";",$parent);
		$parent_control = array();
		foreach($parent_explode as $k=>$p){
			$d = trim($p);
			if($d == "") continue;
			$insertdata = array(
				'module_display_sequence' => $k+1,
				'module_parent_id' => 0,
				'module_name' => $d,
				'module_display' => 'top'
			);
			$this->db->insert("modules",$insertdata);
			$parent_id = $this->db->insert_id();
			$parent_control[$d]['module_id'] = $parent_id;
			$parent_control[$d]['module_name'] = $d;
		}
		foreach($parent_control as $d=>$parent){
			if(isset($data[$d]) ){
				$child_explode = explode(";",$data[$d]['default']);
				foreach($child_explode as $ck=>$c){
					$a = trim($c);
					if($a == "") continue;
					$module_display = 'side';
					$baselink = str_replace(" ","_",$parent['module_name']);
					if(strtolower($d) == "reports") $module_display = 'dropdown-top';
					$link = $baselink . '/'. str_replace(" ","_",$a);
					$link = strtolower($link);
					$insertdata = array(
						'module_display_sequence' => $ck+1,
						'module_parent_id' => $parent['module_id'],
						'module_name' => $a,
						'module_display' => $module_display,
						'module_link' => $link
					);
					$this->db->insert("modules",$insertdata);
					$child_parent_id = $this->db->insert_id();
					if(isset($data[$d][$a]) ){
						$gchild_explode = explode(";",$data[$d][$a]);
						foreach($gchild_explode as $cgk=>$c){
							$a = trim($c);
							if($a == "") continue;
							$module_display = 'default';
							if(strtolower($d) == "reports") $module_display = 'side';
							$link = $baselink . '/'. str_replace(" ","_",$a);
							$link = strtolower($link);
							$insertdata = array(
								'module_display_sequence' => $cgk+1,
								'module_parent_id' => $child_parent_id,
								'module_name' => $a,
								'module_display' => $module_display,
								'module_link' => $link
							);
							$this->db->insert("modules",$insertdata);							
						}
					}
				}
			}
		}
	}
}
