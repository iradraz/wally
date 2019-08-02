<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class User extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('security');
    }

    function index() {
        //   $data['content_view'] = 'user/login_v';
        //   $this->templates->temp($data);
    }

    private function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    function verify_pass() {
        $answer = password_verify('1234567', '$2y$10$FmBeDQSMFtMRZEcjlwVn5uwEZ3P8BgniuG4yn5eWeoQemfiSklENC');
        echo $answer;
    }

    function register_user() {
        $this->form_validation->set_rules('first', 'First Name', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('last', 'Last Name', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'num_dash|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[user.user_email]');
        $this->form_validation->set_rules('pswd', 'Password', 'required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('pswdvrfy', 'Password Verification', 'required|matches[pswd]');

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $post_data = $this->input->post();
            $data = array(
                'user_firstname' => $post_data['first'],
                'user_lastname' => $post_data['last'],
                'user_phone' => $post_data['phone'],
                'user_email' => $post_data['email'],
                'user_password' => $this->hash_password($post_data['pswd']),
                'user_role' => 'client',
                'user_registered_date' => date("Y-m-d H:i:s")
            );

            $session_data = array(
                'user_id' => $this->_insert($data),
                'user_firstname' => $data['user_firstname'],
                'user_lastname' => $data['user_lastname'],
                'user_role' => 'client',
                'user_email' => $data['user_email']
            );
            $this->session->set_userdata($session_data);
            $last_seen = array('user_last_login' => date("Y-m-d H:i:s"));
            $this->_update($session_data['user_id'], $last_seen);
            redirect(base_url('/home/'));
        }
    }

    function show_session() {
        $session_data = $this->session->userdata();
        if (!isset($session_data['user_id'])) {
            print_r($session_data);
        } else {
            $last_seen = array('user_last_login' => date("Y-m-d H:i:s"));
            $this->_update($session_data['user_id'], $last_seen);
            print_r($session_data);
        }
    }

    function register() {
        $this->load->helper('form');

        $data['content_view'] = 'user/register_v';
        $this->templates->landing($data);
    }

    function _login_user() {
        $post_data = $this->input->post();
        $data = $this->get_where_custom('user_email', $post_data['email'])->result_array();
        if (password_verify($post_data['password'], $data[0]['user_password']) == 1) {
            $session_data = array(
                'user_id' => $data[0]['user_id'],
                'user_firstname' => $data[0]['user_firstname'],
                'user_lastname' => $data[0]['user_lastname'],
                'user_role' => $data[0]['user_role'],
                'user_email' => $data[0]['user_email']
            );
            $this->session->set_userdata($session_data);
            $last_seen = array('user_last_login' => date("Y-m-d H:i:s"));
            $this->_update($session_data['user_id'], $last_seen);
            redirect(base_url('/home/'));
        } else {
            redirect(base_url('user/login'));
        }
    }

    function login() {
        $session_data = $this->session->userdata();
        if (!isset($session_data['user_id'])) {

            $post_data = $this->input->post();
            if (isset($post_data['email'])) {
                $this->_login_user();
            } else {
                $data['content_view'] = 'user/login_v';
                $this->templates->landing($data);
            }
        }else
        {
            redirect(base_url('/home/'));
        }
    }

    function get($order_by) {
        $this->load->model('mdl_user');
        $query = $this->mdl_user->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_user');
        $query = $this->mdl_user->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_user');
        $query = $this->mdl_user->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_user');
        $query = $this->mdl_user->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_user');
        $query = $this->mdl_user->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_user');
        $insert_id = $this->mdl_user->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_user');
        $this->mdl_user->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_user');
        $this->mdl_user->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_user');
        $count = $this->mdl_user->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_user');
        $max_id = $this->mdl_user->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_user');
        $query = $this->mdl_user->_custom_query($mysql_query);
        return $query;
    }

}
