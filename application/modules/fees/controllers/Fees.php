<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Fees extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function get($order_by) {
        $this->load->model('mdl_fees');
        $query = $this->mdl_fees->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_fees');
        $query = $this->mdl_fees->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_fees');
        $query = $this->mdl_fees->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_fees');
        $query = $this->mdl_fees->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_fees');
        $query = $this->mdl_fees->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_fees');
        $insert_id = $this->mdl_fees->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_fees');
        $this->mdl_fees->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_fees');
        $this->mdl_fees->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_fees');
        $count = $this->mdl_fees->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_fees');
        $max_id = $this->mdl_fees->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_fees');
        $query = $this->mdl_fees->_custom_query($mysql_query);
        return $query;
    }

}
