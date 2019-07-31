<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Currencies extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('security');
        $this->load->module('fees');
    }

    function add_currency() {

        $this->security->security_test('admin');

        $this->form_validation->set_rules('currency', 'Currency', 'required|exact_length[3]|is_unique[currencies.currency_name]');

        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $post_data = $this->input->post();
            $data = array(
                'currency_name' => strtoupper($post_data['currency']));
            $currency_id = $this->_insert($data);
            $this->fees->_insert(
                    array(
                        'currency_id' => $currency_id,
                        'fee_rate' => 0)
            );
        }
        redirect(base_url('admin/currencies'));
    }

    function _join_fees() {
        $this->security->security_test('admin');
        $mysql_query = 'select currencies.currency_id, fees.fee_id, currencies.currency_name, fees.fee_rate from currencies,fees where currencies.currency_id = fees.currency_id';
        $query = $this->_custom_query($mysql_query);
        return $query;
    }

    function remove_currency($id) {
        $this->security->security_test('admin');
        $post_data = $this->input->post();
        if (isset($post_data['delete_id'])) {
            $this->_delete($post_data['delete_id']);
        }
    }

    function get($order_by) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_currencies');
        $insert_id = $this->mdl_currencies->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_currencies');
        $this->mdl_currencies->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_currencies');
        $this->mdl_currencies->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_currencies');
        $count = $this->mdl_currencies->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_currencies');
        $max_id = $this->mdl_currencies->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->_custom_query($mysql_query);
        return $query;
    }

}
