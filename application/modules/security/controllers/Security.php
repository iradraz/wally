<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Security extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function security_test($role) {
        $session_data = $this->session->userdata();
        if ($session_data['user_id']==null){
            redirect(base_url());
        }
        if ($session_data['user_role'] != $role){
            //insert into a log table in the database 
            $this->session->sess_destroy();
            //redirect('/home/logout');
           echo 'you are not allowed and you have been logged!';
           die;
        }
    }

}