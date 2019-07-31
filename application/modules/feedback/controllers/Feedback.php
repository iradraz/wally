<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Feedback extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function get($order_by) {
        $this->load->model('mdl_feedback');
        $query = $this->mdl_feedback->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_feedback');
        $query = $this->mdl_feedback->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_feedback');
        $query = $this->mdl_feedback->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_feedback');
        $query = $this->mdl_feedback->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_feedback');
        $query = $this->mdl_feedback->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_feedback');
        $insert_id = $this->mdl_feedback->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_feedback');
        $this->mdl_feedback->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_feedback');
        $this->mdl_feedback->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_feedback');
        $count = $this->mdl_feedback->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_feedback');
        $max_id = $this->mdl_feedback->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_feedback');
        $query = $this->mdl_feedback->_custom_query($mysql_query);
        return $query;
    }

}
