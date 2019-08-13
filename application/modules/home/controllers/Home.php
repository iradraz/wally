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
    function provider(){
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

}
