<?php

class Client extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('security');
        $this->load->module('user');
        $this->load->module('transactions');
        $this->load->module('currencies');
        $this->load->module('api');
    }

    function wallet() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $data['transactions'] = $this->get_transactions()->result_array();
        $data['transactions_summary'] = $this->get_transactions_summary()->result_array();
        $data['currencies_summary'] = $this->get_currencies_summary()->result_array();
        $data['content_view'] = 'client/wallet_v';
        $this->templates->client($data);
    }

    function exchange() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $data['transactions_summary'] = $this->get_transactions_summary()->result_array();
        $data['currencies_summary'] = $this->get_currencies_summary()->result_array();
        $data['available_currencies'] = $this->currencies->get('currency_id')->result_array();
        $data['content_view'] = 'client/start_exchange_v';
        $this->templates->client($data);
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

    function check_exchange() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $post_data = $this->input->post();
        $data['post_data'] = $post_data;
        $summary = $this->get_currency_sum($post_data['exch_from_currency'])->result_array()[0];

        if ($post_data['amount'] > ($summary['sum(amount)'] + $summary['sum(fee_paid)']) || $post_data['exch_from_currency'] == $post_data['exch_to_currency']) {// wrong data enter or same currency
            echo 'your IP has been logged and has been reported!!';
            $data['content_view'] = 'client/faulty_v';
            $this->templates->client($data);
        } else {
            $first_rate = $this->api->get_rate_1($post_data['exch_from_currency'], $post_data['exch_to_currency'], $post_data['amount']);
            $first_rate = json_decode($first_rate, true);
            $second_rate = $this->api->get_rate_2($post_data['exch_from_currency'], $post_data['exch_to_currency'], $post_data['amount']);
            $second_rate = json_decode($second_rate, true);

            $data['first_rate'] = $first_rate;
            $data['second_rate'] = $second_rate;
            $data['wally_fee_rate'] = $this->get_currency_rate($post_data['exch_to_currency'])->result_array()[0]['fee_rate'];
            $data['post_data'] = $post_data;
            $data['content_view'] = 'client/show_exchange_rates_v';
            $this->templates->client($data);
        }
    }

    function create_exchange() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $post_data = $this->input->post();

        $data['content_view'] = 'client/exchange_success_v';
        $this->templates->client($data);
    }

    function approve() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $get_data = $this->input->get();
        //add database funding into a client here

        $data['currency'] = 'USD';
        $data['currency_id'] = $this->currencies->get_where_custom('currency_name', $data['currency'])->result_array()[0]['currency_id'];

        //need to check if possible data directly from blueplay, this method using GET is a serious security breach

        $this->transactions->_insert(
                array(
                    'user_id' => $session_data['user_id'],
                    'currency_id' => $data['currency_id'],
                    'action' => 'DEPOSIT',
                    'amount' => $get_data['AMOUNT']
                )
        );
        $data['get_data'] = $get_data;

        $data['content_view'] = 'client/add_funds_step_2_v';
        $this->templates->client($data);
    }

    function decline() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $get_data = $this->input->get();

        $data['get_data'] = $get_data;

        $data['content_view'] = 'client/decline_deposit_v';
        $this->templates->client($data);
    }

    function error() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $get_data = $this->input->get();

        $data['get_data'] = $get_data;

        $data['content_view'] = 'client/error_deposit_v';
        $this->templates->client($data);
    }

    function make_exchange_cc() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $post_data = $this->input->post();
        $data['post_data'] = $post_data;
        $output = $this->api->create_conversion_1(); //create transferid
        $output = json_decode($output, true);

        if (isset($output['partner_status']) == 'funds_arrived') { //success
            $sell_currency = $this->get_currency_rate($post_data['source'])->result_array()[0];
            $buy_currency = $this->get_currency_rate($post_data['target'])->result_array()[0];
            $this->transactions->_insert(//sell transaction
                    array(
                        'user_id' => $session_data['user_id'],
                        'currency_id' => $sell_currency['currency_id'],
                        'action' => 'Sell',
                        'amount' => -$post_data['sourceAmount'],
                        'fee_paid' => 0,
                        'broker_name' => 'currencycloud',
                        'transaction_key' => $output['id']
                    )
            );
            $this->transactions->_insert(//buy transaction
                    array(
                        'user_id' => $session_data['user_id'],
                        'currency_id' => $buy_currency['currency_id'],
                        'action' => 'Buy',
                        'amount' => $post_data['targetAmount'],
                        'fee_paid' => -$buy_currency['fee_rate'] * $post_data['targetAmount'],
                        'broker_name' => 'currencycloud',
                        'transaction_key' => $output['id']
                    )
            );
            $data['content_view'] = 'client/exchange_success_v';
            $this->templates->client($data);
        } else if (isset($output['error_messages']['amount'][0]['code']) == 'conversion_below_limit') {
            echo 'error-conversion_below_limit - failed to convert!! return and exchange more';
            $data['content_view'] = 'client/exchange_fault_v';
            $this->templates->client($data);
        }
    }

    function make_exchange_tw() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $post_data = $this->input->post();
        $data['post_data'] = $post_data;
        $output = $this->api->make_transfer_2($post_data['quoteid']); //create transferid
        $output = json_decode($output, true);

        $fund_confirm = $this->api->make_fund_2($output['id']); //using transfer id to commit the transfer
        $sell_currency = $this->get_currency_rate($post_data['source'])->result_array()[0];
        $buy_currency = $this->get_currency_rate($post_data['target'])->result_array()[0];
        if ($fund_confirm == 'success') { // succed to make the transaction
            $this->transactions->_insert(//sell transaction
                    array(
                        'user_id' => $session_data['user_id'],
                        'currency_id' => $sell_currency['currency_id'],
                        'action' => 'Sell',
                        'amount' => -$post_data['sourceAmount'],
                        'fee_paid' => 0,
                        'broker_name' => 'transferwise',
                        'quote_id' => $post_data['quoteid'],
                        'transaction_key' => $output['id']
                    )
            );
            $this->transactions->_insert(//buy transaction
                    array(
                        'user_id' => $session_data['user_id'],
                        'currency_id' => $buy_currency['currency_id'],
                        'action' => 'Buy',
                        'amount' => $post_data['targetAmount'] - $post_data['fee'],
                        'fee_paid' => -$buy_currency['fee_rate'] * $post_data['targetAmount'],
                        'broker_name' => 'transferwise',
                        'quote_id' => $post_data['quoteid'],
                        'transaction_key' => $output['id']
                    )
            );
            $data['content_view'] = 'client/exchange_success_v';
            $this->templates->client($data);
        }
    }

    function settings() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        echo 'settings page will come here';
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
        $query = 'select a.currency_id, a.currency_name,b.fee_paid,b.user_id,b.currency_id,b.action,sum(amount),sum(fee_paid) from currencies a, transactions b where a.currency_id=b.currency_id and b.user_id=' . $user_id . ' group by a.currency_id, a.currency_name,b.user_id,b.currency_id;';
        $data = $this->_custom_query($query);
        return $data;
    }

    function get_currency_sum($currency_name) {
        $this->security->security_test('client');
        $this->load->model('mdl_client');
        $session_data = $this->session->userdata();
        $user_id = $session_data['user_id'];
        $query = 'select a.currency_id, a.currency_name,b.fee_paid,b.user_id,b.currency_id,b.action,sum(amount),sum(fee_paid) from currencies a, transactions b where a.currency_id=b.currency_id and b.user_id=' . $user_id . ' and a.currency_name="' . $currency_name . '" group by a.currency_id, a.currency_name,b.user_id,b.currency_id;';
        $data = $this->_custom_query($query);
        return $data;
    }

    function get_transactions_summary() {
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

    //
    function get_currency_rate($currency_name) {
        $this->security->security_test('client');
        $this->load->model('mdl_client');

        $query = "select a.currency_id,a.currency_name,b.fee_rate from currencies a,fees b where a.currency_id=b.currency_id and a.currency_name='$currency_name'";
        $data = $this->_custom_query($query);
        return $data;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_client');
        $query = $this->mdl_client->_custom_query($mysql_query);
        return $query;
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

}
