<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('feedback');
        $this->load->module('user');
        $this->load->module('security');
        $this->load->module('transactions');
        $this->load->module('currencies');
        $this->load->module('fees');
    }

    function user_management() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();
        $data['users'] = $this->get_users_summary();
        $data['content_view'] = 'admin/user_management_v';
        $this->templates->admin($data);
    }

    function suspend_revert() {
        $this->security->security_test('admin');

        $post_data = $this->input->post();
        $user_id = $post_data['user_id'];
        $sql_user_role = "select user_role from user where user_id='$user_id';";
        $user_role = $this->_custom_query($sql_user_role)->result_array()[0]['user_role'];
        if($user_role=='client'){ // need to suspend client
            $user_role='suspended';
            $status='Suspended';
        } else{
            $user_role='client';
            $status='Active';
        }
        $sql = "update user set user_role='$user_role' where user_id='$user_id';";
        $result = $this->_custom_query($sql);
        $returnData = array(
            'status' => 'ok',
            'msg' => 'User data has been updated successfully.',
            'data' => array('user_role'=>$status)
        );
        echo json_encode($returnData);
    }

    function get_users_summary() {
        $sql = 'select user_id,user_firstname,user_lastname,user_email,user_phone,user_role,user_registered_date,user_last_login from user where user_role != "admin";';
        $output = $this->_custom_query($sql)->result_array();
        return $output;
    }

    function fees() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();
        $data['currencies_data'] = $this->currencies->_join_fees()->result_array();
        $data['content_view'] = 'admin/fees_v';
        $this->templates->admin($data);
    }

    function update_fee() {
        $this->security->security_test('admin');
        $post_data = $this->input->post();
        $fee_id = $post_data['fee_id'];
        $fee_rate = $post_data['fee_rate'];
        $current_date = date("Y-m-d H:i:s");
        $update_data = array('fee_id' => $post_data['fee_id'], 'fee_rate' => $post_data['fee_rate'], 'change_date' => $current_date);
        $sql = "update fees set fee_rate='$fee_rate', change_date='$current_date' where fee_id='$fee_id';";
        $result = $this->_custom_query($sql);
        $returnData = array(
            'status' => 'ok',
            'msg' => 'User data has been updated successfully.',
            'data' => $update_data
        );
        echo json_encode($returnData);
    }

    function get_transactions_data() {
        $this->security->security_test('admin');

        $query = 'select transactions.transaction_id,transactions.user_id,transactions.transaction_date,transactions.currency_id,currencies.currency_name,transactions.action,transactions.amount,transactions.fee_paid,transactions.transaction_date from transactions,currencies where transactions.currency_id=currencies.currency_id order by transactions.transaction_id desc';
        $result = $this->transactions->_custom_query($query);

        return $result;
    }

    function currencies() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();

        $post_data = $this->input->post();
        if (isset($post_data['currency'])) {
            $this->currencies->add_currency();
        }
        $data['currencies_data'] = $this->currencies->get('currency_id')->result_array();
        $data['content_view'] = 'admin/add_currencies_v';
        $this->templates->admin($data);
    }

    function transactions() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();

        $data['transactions'] = $this->get_transactions_data()->result_array();

        $data['content_view'] = 'admin/transactions_v';
        $this->templates->admin($data);
    }

    function review_providers() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();

        $data['providers'] = $this->providers_summary();
        $data['content_view'] = 'admin/review_providers_v';
        $this->templates->admin($data);
    }

    function providers_summary() {
        $query = 'select * from providers';
        $output = $this->_custom_query($query)->result_array();
        return $output;
    }

    function statistics() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();

        //gather all transaction info here and put it in $data
        $data['content_view'] = 'admin/statistics_v';
        $this->templates->admin($data);
    }

    function feedback() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();


        $feedback_data = $this->feedback->get('feedback_date')->result_array();
        foreach ($feedback_data as $key => $value) {
            $query = $this->user->get_where($feedback_data[$key]['user_id'])->result_array()[0];
            $feedback_data[$key]['user_firstname'] = $query['user_firstname'];
            $feedback_data[$key]['user_lastname'] = $query['user_lastname'];
        }

        $data['content_view'] = 'admin/feedback_v';
        $data['feedback_data'] = $feedback_data;
        $this->templates->admin($data);
    }

    function get($order_by) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_admin->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_admin->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_admin->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_admin->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_admin->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_admin');
        $insert_id = $this->mdl_admin->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_admin');
        $this->mdl_admin->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_admin');
        $this->mdl_admin->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_admin');
        $count = $this->mdl_admin->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_admin');
        $max_id = $this->mdl_admin->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_admin->_custom_query($mysql_query);
        return $query;
    }

}
