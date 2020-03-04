<?php
/**
 * Created by PhpStorm.
 * User: Wishaal
 * Date: 12/28/2017
 * Time: 11:10 AM
 */

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
$client = new SoapClient("http://:8080/gas/ws/r/tlsr/getSearchCustomer?WSDL");

//echo var_dump($client->__getFunctions());
$key = $_GET['query'];
$extra = null;
if($_GET['type'] == 1){
    $params = array (
        "serv_number" => $key
    );

    $extra = $key;
}else{
    $params = array (
        "customer" => $key
    );
}




$response = $client->__soapCall('getSearchCustomers', array($params));

$data = array();
if($response->totrec == 1){
    $data[] = $response->list->element->cust_num . '-'. trim($response->list->element->cust_name). ' '. trim($response->list->element->cust_fname).' '.$extra;
}else{
    foreach ($response->list->element as $r)
    {

        $data[] = $r->cust_num . '-'. trim($r->cust_name). ' '. trim($r->cust_fname).' '.$extra;
    }
}
//returns data as JSON format
echo json_encode($data);