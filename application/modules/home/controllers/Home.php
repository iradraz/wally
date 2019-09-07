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
            /* $data['content_view'] = 'client/client_home_v'; // this is a way around to avoid the front page
              $this->templates->client($data); */
            $this->load->module('client');
            $this->client->wallet();
        } else if ($session_data['user_role'] == 'admin') {
            $data['content_view'] = 'admin/admin_home_v';
            $this->templates->admin($data);
        } else {
            $data['content_view'] = 'home/home_v';
            $this->templates->landing($data);
        }
    }

    function provider() {
        $post_data = $this->input->post();
        $config['allowed_types'] = 'pdf';
        $config['upload_path'] = './files/' . $post_data['provider_name'];
        if (!is_dir('./files/' . $post_data['provider_name'])) {
            mkdir('./files/' . $post_data['provider_name'], 0777, TRUE);
        }
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $provider_name = $post_data['provider_name'];
        $supported_currencies = $post_data['supported_currencies'];
        $contact_email = $post_data['contact_email'];
        $contact_phone = $post_data['contact_phone'];

        //$this->upload->do_upload('file');
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            $error_explode = explode(' ', $error['error']);
            if (strcmp($error_explode[2], 'not') == 0 && strcmp($error_explode[3], 'select') == 0) { //no files have been uploaded, insert into db without filename
                $data = array('upload_data' => $this->upload->data());
                $filename = $data['upload_data']['file_name'];
                $sql = "INSERT into providers(`provider_name`,`supported_currencies`,`contact_email`,`contact_phone`,`file`)"
                        . " values ('$provider_name','$supported_currencies','$contact_email','$contact_phone','')";
                $this->_custom_query($sql);

                $data['content_view'] = 'home/provider_sign_thank_you_v';
                $this->templates->landing($data);
            } else { //something wrong with uploaded files
                $data['error'] = $error;
                $data['content_view'] = 'home/provider_sign_failed_v';
                $this->templates->landing($data);
            }
        } else { // uploaded succesfully, insert filename into database
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
            $sql = "INSERT into providers(`provider_name`,`supported_currencies`,`contact_email`,`contact_phone`,`file`)"
                    . " values ('$provider_name','$supported_currencies','$contact_email','$contact_phone','$filename')";
            $this->_custom_query($sql);

            $data['content_view'] = 'home/provider_sign_thank_you_v';
            $this->templates->landing($data);
        }
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
