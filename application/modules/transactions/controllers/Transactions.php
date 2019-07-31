<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Transactions extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function test() {
    }

    function join() {
        $this->load->model('mdl_transactions');
        $query = $this->mdl_transactions->join(3);
        return $query;
    }

    function get($order_by) {
        $this->load->model('mdl_transactions');
        $query = $this->mdl_transactions->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_transactions');
        $query = $this->mdl_transactions->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_transactions');
        $query = $this->mdl_transactions->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_transactions');
        $query = $this->mdl_transactions->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_transactions');
        $query = $this->mdl_transactions->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_transactions');
        $insert_id = $this->mdl_transactions->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_transactions');
        $this->mdl_transactions->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_transactions');
        $this->mdl_transactions->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_transactions');
        $count = $this->mdl_transactions->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_transactions');
        $max_id = $this->mdl_transactions->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_transactions');
        $query = $this->mdl_transactions->_custom_query($mysql_query);
        return $query;
    }

}
