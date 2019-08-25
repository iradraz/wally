<?php

class Client extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('security');
        $this->load->module('user');
        $this->load->module('transactions');
        $this->load->module('currencies');
    }

    function feedback_post() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $this->form_validation->set_rules('feedback_text', 'Feedback Text', 'required|max_length[300]');
        $post_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->feedback();
        } else {
            $data = array(
                'user_id' => $session_data['user_id'],
                'feedback_text' => $post_data['feedback_text'],
            );
            $this->load->module('feedback');
            $this->feedback->_insert($data);
            redirect(base_url('/home/'));
        }
    }

    function subscribe() {
        $this->load->view('client/thank_you_v');
    }

    function feedback() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $data['content_view'] = 'client/feedback_v';
        $this->templates->client($data);
    }

    function wallet() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $data['transactions'] = $this->get_transactions()->result_array();
        $data['currencies_summary'] = $this->get_currencies_summary()->result_array();

        $data['content_view'] = 'client/wallet_v';
        $this->templates->client($data);
    }

    function exchange() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $data['currencies_summary'] = $this->get_currencies_summary()->result_array();
        $data['available_currencies'] = $this->currencies->get('currency_id')->result_array();
        $data['content_view'] = 'client/start_exchange_v';
        $this->templates->client($data);
    }

    function withdraw() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        echo 'withdraw page will come here';
    }

    function deposit() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $post_data = $this->input->post();
        if ($post_data == null) {
            $data['currencies_data'] = $this->currencies->get('currency_id')->result_array();
            $data['content_view'] = 'client/add_funds_step_1_v';
            $this->templates->client($data);
        } else {
            
        }
    }

    function approve() {
        $this->security->security_test('client');

        $get_data = $this->input->get();
        $data['get_data'] = $get_data;
        $session_data = $this->session->userdata();
        $data['content_view'] = 'client/add_funds_step_2_v';
        $this->templates->client($data);
    }

    function settings() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        echo 'settings page will come here';
    }

    function use_curl2() {

        $url = "https://api.sandbox.transferwise.tech/v1/profiles";

        $curl = curl_init();
        $headers = [
            "Authorization: Bearer 140bef54-a3c6-4fb5-ad43-4a07cc1a8700"
        ];
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 0,
            //CURLOPT_USERPWD => "111111:140bef54-a3c6-4fb5-ad43-4a07cc1a8700",
            CURLOPT_HTTPHEADER => $headers
        ]);
// Send the request & save response to $resp
        $resp = curl_exec($curl);
// Close request to clear up some resources
        curl_close($curl);
        // echo '<pre>';
        print_r($resp);
        //  echo '</pre>';
        //  curl_close($ch);
    }

    function transaction() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $post_data = $this->input->post();
        if ($post_data['submit'] == 'back') {
            $data['currencies_data'] = $this->currencies->get('currency_id')->result_array();
            $data['content_view'] = 'client/add_funds_step_1_v';
            $this->templates->client($data);
        } else if ($post_data['submit'] == 'submit') {
            $this->load->module('user');
            $user_data = $this->user->get_where_custom('user_id', $session_data['user_id'])->result_array();
            // $current_status = $user_data[0]['user_' . strtolower($post_data['currency'])];
            //  $this->user->_update($session_data['user_id'], array('user_' . strtolower($post_data['currency']) => $current_status + $post_data['amount']));

            $data['content_view'] = 'client/transaction_success_v';
            $data['amount'] = $post_data['amount'];
            $data['currency'] = $post_data['currency'];
            $data['currency_id'] = $this->currencies->get_where_custom('currency_name', $data['currency'])->result_array()[0]['currency_id'];

            //add here insertion into log table, and add jquery ajax call in the admin review table
            $this->transactions->_insert(
                    array(
                        'user_id' => $session_data['user_id'],
                        'currency_id' => $data['currency_id'],
                        'action' => 'DEPOSIT',
                        'amount' => $data['amount']
                    )
            );
            $this->templates->client($data);
        }
        /*
          credit card info into database if I will decide to integrate with API
          $credit_card= $post_data['credit_card'];
          $cvv=$post_data['cvv'];
          $currency=$post_data['currency'];
          $amount=$post_data['amount'];
         */
    }

    function get_transactions() {
        $this->security->security_test('client');
        $this->load->model('mdl_client');
        $session_data = $this->session->userdata();
        $user_id = $session_data['user_id'];
        $query = 'select * from user,transactions,currencies where user.user_id=transactions.user_id and transactions.currency_id=currencies.currency_id and user.user_id=' . $user_id . ' order by transactions.transaction_id asc';
        $data = $this->_custom_query($query);

        // $data = $this->mdl_client->join($session_data['user_id']);
        return $data;
    }

    function get_currencies_summary() {
        $this->security->security_test('client');
        $this->load->model('mdl_client');
        $session_data = $this->session->userdata();
        $user_id = $session_data['user_id'];

        $query = 'select transactions.user_id, transactions.amount,transactions.fee_paid,currencies.currency_id,currencies.currency_name '
                . 'from user,transactions,currencies where '
                . 'transactions.currency_id=currencies.currency_id and transactions.user_id=' . $user_id . ' '
                . 'GROUP BY currencies.currency_name;';
        $data = $this->_custom_query($query);
        // $data = $this->mdl_client->join_group_by($session_data['user_id']);
        return $data;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_client');
        $query = $this->mdl_client->_custom_query($mysql_query);
        return $query;
    }

}
