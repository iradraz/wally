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

    function test_payment() {
        $data['accountID'] = "1";
        $data['secretKey'] = "2";
        $data['mode'] = "TEST";

        $payment = new bluepay($data);
//        echo '<pre>';
//        print_r($payment);
//        echo '</pre>';
        $payment->setCustomerInformation(array(
            'firstName' => 'Bob',
            'lastName' => 'Tester',
            'addr1' => '1234 Test St.',
            'addr2' => 'Apt #500',
            'city' => 'Testville',
            'state' => 'IL',
            'zip' => '54321',
            'country' => 'USA',
            'phone' => '1231231234',
            'email' => 'test@bluepay.com'
        ));



        $payment->setCCInformation(array(
            'cardNumber' => '4111111111111111', // Card Number: 4111111111111111
            'cardExpire' => '1225', // Card Expire: 12/25
            'cvv2' => '123' // Card CVV2: 123
        ));

        $payment->sale('300.00'); // Sale Amount: $300.00
        // Makes the API request with BluePAy
        $payment->process();

// Reads the response from BluePay
        $payment->getStatus();
        die;
        if ($payment->isSuccessfulResponse()) {
            echo
            'Transaction Status: ' . $payment->getStatus() . "\n" .
            'Transaction Message: ' . $payment->getMessage() . "\n" .
            'Transaction ID: ' . $payment->getTransID() . "\n" .
            'AVS Response: ' . $payment->getAVSResponse() . "\n" .
            'CVS Response: ' . $payment->getCVV2Response() . "\n" .
            'Masked Account: ' . $payment->getMaskedAccount() . "\n" .
            'Card Type: ' . $payment->getCardType() . "\n" .
            'Authorization Code: ' . $payment->getAuthCode() . "\n";
        } else {
            echo $payment->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($payment);
        echo '</pre>';
        die;
    }

    function get_auth_1() {

        $url = "https://devapi.currencycloud.com/v2/authenticate/api";
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 0,
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

    function get_balance_1() {
        $auth = $this->get_auth_1();
        $url = "https://devapi.currencycloud.com/v2/balances/find";
        $curl = curl_init();
        $headers = array("X-Auth-Token: $auth");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);

        echo '<pre>';
        print_r($output);
        echo '</pre>';
    }

//https://devapi.currencycloud.com/v2/rates/find?currency_pair=GBPUSD
//curl -X GET https://devapi.currencycloud.com/v2/rates/detailed?
//      $url = sprintf("%s?%s", $url, http_build_query($data));
    function get_rate_1($currency1, $currency2) {
        $pair = strtoupper($currency1 . $currency2);
        $auth = $this->get_auth_1();
        $url = "https://devapi.currencycloud.com/v2/rates/find?currency_pair=$pair";
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

}
