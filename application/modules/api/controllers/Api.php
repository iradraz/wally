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
       // $this->load->library('bluepay');
    }

    //Bluepay api is within the funding form

    /**
     * first section is for CurrencyCloud API integration
     * 
     */
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

    //curl -X POST -d "buy_currency=GBP&sell_currency=USD&fixed_side=BUY&amount=100&term_agreement=1" --header "X-Auth-Token: XXXX-XXXXX-XXXX"  https://devapi.currencycloud.com/v2/conversions/create
    function create_conversion_1() {
        $post_data = $this->input->post();
        $currency1 = strtoupper($post_data['source']);
        $currency2 = strtoupper($post_data['target']);
        $amount = $post_data['sourceAmount'];
        $auth = $this->get_auth_1();
        $url = "https://devapi.currencycloud.com/v2/conversions/create";
        $curl = curl_init();

        $headers = array(
            "X-Auth-Token: $auth",
            'Content-Type: application/json'
        );
        $data = array(
            'sell_currency' => "$currency1",
            'buy_currency' => "$currency2",
            'fixed_side' => "sell",
            'amount' => $amount,
            'term_agreement' => true
            );
        $data_string = json_encode($data);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $output = curl_exec($curl);

        curl_close($curl);
//        echo '<pre>';
//        print_r($output);
//        echo '</pre>';die;
        return $output;
    }

    /**
     * second section is for TransferWise API integration
     * 
     */
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

    function get_rate_2($currency1, $currency2, $amount) { //transferwise
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

    function make_transfer_2($quoteid) { //transferwise
        $auth = $this->get_auth_2();
        $url = "https://api.sandbox.transferwise.tech/v1/transfers";
        $data = array(
            "targetAccount" => 14382604, //this is our profile unique recipent ID -> we get this is we check our profile id which is 7850
            "quote" => $quoteid,
            "customerTransactionId" => "b0cfbd04-cc1f-11e9-a32f-2a2ae2dbcce6", //this is just a generic UUID to make the transaction going, in real environment we need to make it unique
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

    function make_fund_2($transferid) {
        return 'success';
    }

}
