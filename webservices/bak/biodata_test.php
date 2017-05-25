<?php
	ini_set("display_errors", 1);
	$client = new SoapClient("http://personnel.dusit.ac.th/eprofile/webservices/biodata.wsdl");
	$catalogId = '1005-181';
	//print_r($client->__getFunctions());
	$response = $client->getBiodataEntry($catalogId);
	
	
	//echo "<pre>";
	//print "1234";
	//print_r($response);
	//echo "</pre>";
	//echo gettype($response);
	
	//echo $response;
    
//	foreach($response as $k) {
	//	echo $k . "<br />";
	//}
?>