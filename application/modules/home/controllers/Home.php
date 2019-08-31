<?php

class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $session_data = $this->session->userdata();
        if (!isset($session_data['user_role'])) {
            $session_data['user_role'] = '';
        }

        if ($session_data['user_role'] == 'client') {
            $data['content_view'] = 'client/client_home_v';

            $this->templates->client($data);
        } else if ($session_data['user_role'] == 'admin') {
            $data['content_view'] = 'admin/admin_home_v';
            $this->templates->admin($data);
        } else {
            $data['content_view'] = 'home/home_v';
            $this->templates->landing($data);
        }
    }

    function provider() {
//               $this->transactions->_insert(
//                array(
//                    'user_id' => $session_data['user_id'],
//                    'currency_id' => $data['currency_id'],
//                    'action' => 'DEPOSIT',
//                    'amount' => $get_data['AMOUNT']
//                )
//        );
        $post_data = $this->input->post();
        $provider_name = $post_data['provider_name'];
        $supported_currencies = $post_data['supported_currencies'];
        $contact_email = $post_data['contact_email'];
        $contact_phone = $post_data['contact_phone'];
        
        print_r($post_data);

        $sql = "INSERT into providers(`provider_name`,`supported_currencies`,`contact_email`,`contact_phone`)"
                . " values ('$provider_name','$supported_currencies','$contact_email','$contact_phone')";
        $this->_custom_query($sql);
        $this->load->view('home/provider_sign_thank_you_v');
    }

    function about() {
        $data['content_view'] = 'home/about_v';
        $this->templates->landing($data);
    }

    function logout() {
        session_destroy();
        redirect(base_url());
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_home');
        $query = $this->mdl_home->_custom_query($mysql_query);
        return $query;
    }

}
