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

    function fees() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();
        $data['currencies_data'] = $this->currencies->_join_fees()->result_array();
        $data['content_view'] = 'admin/fees_v';
        $this->templates->admin($data);
    }

    function get_transactions_data() {
        $this->security->security_test('admin');

        $query = 'select transactions.transaction_id,transactions.user_id,transactions.currency_id,currencies.currency_name,transactions.action,transactions.amount,transactions.fee_paid,transactions.transaction_date from transactions,currencies where transactions.currency_id=currencies.currency_id';
        $result = $this->transactions->_custom_query($query);

        return $result;
    }

    function transactions() {
        $this->security->security_test('admin');
        $session_data = $this->session->userdata();
        
        $data['transactions'] = $this->get_transactions_data()->result_array();

        $data['content_view'] = 'admin/transactions_v';
        $this->templates->admin($data);
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
        $query = $this->mdl_test->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_test->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_test->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_test->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_test->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_admin');
        $insert_id = $this->mdl_test->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_admin');
        $this->mdl_test->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_admin');
        $this->mdl_test->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_admin');
        $count = $this->mdl_test->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_admin');
        $max_id = $this->mdl_test->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_admin');
        $query = $this->mdl_test->_custom_query($mysql_query);
        return $query;
    }

}
