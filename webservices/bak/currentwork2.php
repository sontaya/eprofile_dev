<?php

$client = new SoapClient("currentwork.wsdl");
$catalogId = '3770400570473';
//print_r($client->__getFunctions());
$response = $client->getCurrentworkEntry($catalogId);

echo $response;


    //$xml = simplexml_load_file('person1.xml');
 
    //print_r($xml);

?>