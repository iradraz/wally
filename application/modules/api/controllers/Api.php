<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Api extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('security');
        $this->security->security_test('client');
        $this->load->library('bluepay');
    }

    function test_form_2() {
        $session_data = $this->session->userdata();
        $data['content_view'] = 'client/test_fund_2_v';
        $this->templates->client($data);
    }

    function test_form() {
        $this->security->security_test('client');
        $session_data = $this->session->userdata();
        $data['content_view'] = 'client/test_fund_v';
        $this->templates->client($data);
    }

    function get_auth_1() { //currencycloud
        $url = "https://devapi.currencycloud.com/v2/authenticate/api";
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => [
                'login_id' => 'iradra@mta.ac.il',
                'api_key' => 'c3355e7a58cceaa964baa867e7b5db23dd8f3a9129aac698ccaf93c247e2613b'
            ]
        ]);

        $output = curl_exec($curl);
        $auth = json_decode($output)->auth_token;
        curl_close($curl);

        return $auth;
    }

    function get_auth_2() { //transferwise
        $url = "https://api.sandbox.transferwise.tech/v1/profiles";
        $headers = [
            "Content-Type: application/json;charset=UTF-8",
            "Authorization: Bearer 9d95ff59-f7e5-434e-a8e3-951b3e51920e"
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 0,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $output = curl_exec($curl);
        $business_id = json_decode($output)[1]->id;
        curl_close($curl);
        return $business_id;
    }

    function get_rate_1($currency1, $currency2, $amount) {
        $pair = strtoupper($currency1 . $currency2);
        $auth = $this->get_auth_1();
        $url = "https://devapi.currencycloud.com/v2/rates/detailed?sell_currency=$currency1&buy_currency=$currency2&fixed_side=sell&amount=$amount";
        $curl = curl_init();

        $headers = array(
            "X-Auth-Token: $auth",
            'Content-Type: application/json'
        );

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

        $output = curl_exec($curl);
        curl_close($curl);
//        echo '<pre>';
//        print_r($output);
//        echo '</pre>';
        return $output;
    }

    function get_rate_2($currency1, $currency2, $amount) {

        $auth = $this->get_auth_2();
        $url = "https://api.sandbox.transferwise.tech/v1/quotes";
        $data = array(
            "profile" => 7850,
            "source" => "$currency1",
            "target" => "$currency2",
            "rateType" => "FIXED",
            "sourceAmount" => "$amount",
            "type" => "BALANCE_CONVERSION"
        );
        $data_string = json_encode($data);
        $curl = curl_init();
        $headers = [
            "Content-Type: application/json;charset=UTF-8",
            "Authorization: Bearer 9d95ff59-f7e5-434e-a8e3-951b3e51920e"
        ];

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    //curl -X POST -d "buy_currency=GBP&sell_currency=USD&fixed_side=BUY&amount=100&term_agreement=1" --header "X-Auth-Token: XXXX-XXXXX-XXXX"  https://devapi.currencycloud.com/v2/conversions/create
    function create_conversion_1() {
        $post_data = $this->input->post();
        $currency1 = strtoupper($post_data['currency1']);
        $currency2 = strtoupper($post_data['currency2']);

        $auth = $this->get_auth_1();
        $url = "https://devapi.currencycloud.com/v2/conversions/create";
        $curl = curl_init();

        $headers = array(
            "X-Auth-Token: $auth",
            'Content-Type: application/json'
        );
        $data = array('currency_pair' => 'GBPUSD');
        $data_string = json_encode($data);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $output = curl_exec($curl);

        curl_close($curl);
//        echo '<pre>';
//        print_r($output);
//        echo '</pre>';
        return $output;
    }

    function test_bluepay() {

        $report = new CI_BluePay();

        $report->getSingleTransQuery(array(
            'transID' => 100765920893, // required transID:CI_BluePay:private
            'errors' => '1' // Do not include errored transactions? Yes
        ));
// Makes the API request with BluePay 
        $report->process();
        echo '<pre>';
        print_r($report);
        echo '</pre>';
        die;
// Reads the response from BluePay
        echo
        'Response: ' . $report->getResponse() . "\n" .
        'First Name: ' . $report->getName1() . "\n" .
        'Last Name:  ' . $report->getName2() . "\n" .
        'Transaction ID: ' . $report->getID() . "\n" .
        'Payment Type ' . $report->getPaymentType() . "\n" .
        'Transaction Type: ' . $report->getTransType() . "\n" .
        'Amount: ' . $report->getAmount() . "\n";
    }

}
