<?php
	header ("content-type: text/xml");
	$client = new SoapClient("http://personnel.dusit.ac.th/eprofile/webservices/address.wsdl");
	$empId = '1005-181';
	$response = $client->usradd($empId);
	echo $response;
  
?>