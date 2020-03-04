<?php
/**
 * Created by PhpStorm.
 * User: Wishaal
 * Date: 12/28/2017
 * Time: 11:10 AM
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$client = new SoapClient("http://:8080/gas/ws/r/tlsr/getCustomerServices?WSDL");

//echo var_dump($client->__getFunctions());

$params = array (
    "cust_num" => $_POST['cust_num']
);

$response = $client->__soapCall('getCustomerServices', array($params));

$data = array();

$data['status'] = 'ok';
$data['result'] = $response;

//returns data as JSON format
echo json_encode($data);