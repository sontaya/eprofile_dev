<?php
	$client = new SoapClient("salaryall.wsdl");
	$catalogId = '1005-181';
	//print_r($client->__getFunctions());
	$response = $client->getSalaryallEntry($catalogId);
	
	
	//echo "<pre>";
	//print_r($response);
	//echo "</pre>";
	//echo gettype($response);
	
	echo $response;
//	foreach($response as $k) {
	//	echo $k . "<br />";
	//}
?>