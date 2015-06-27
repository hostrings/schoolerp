<?php
class Demo extends CI_Controller{

    public function index(){

        // This will override any configuration parameters set on the config file
        $params = array('user' => '', 'password' => '', 'api_id' => 'myid');  
        $this->load->library('clickatel', $params);

        // Send the message
        $this->clickatel->send_sms('3519333333', 'This is a test message');

        // Get the reply
        echo $this->clickatel->last_reply();

        // Send message to multiple numbers
        $numbers = array('351965555555', '351936666666', '351925555555');
        $this->clickatel->send_sms($numbers, 'This is a test message');
    }
}