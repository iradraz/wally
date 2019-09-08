<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Security extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('user');
    }

    function security_test($role) {
        $session_data = $this->session->userdata();
        $user_id=$session_data['user_id'];
        $sql_user_role = "select user_role from user where user_id='$user_id';";
        $user_role = $this->user->_custom_query($sql_user_role)->result_array()[0]['user_role'];

        if ($session_data['user_id'] == null) {
            redirect(base_url());
        }
        if ($session_data['user_role'] != $role) {
            //insert into a log table in the database 
            $this->session->sess_destroy();
            //redirect('/home/logout');
            echo 'you are not allowed and you have been logged!';
            die;
        }
        if($user_role=='suspended'){
            echo 'your session has been suspeneded';
            die;
        }
    }

}
