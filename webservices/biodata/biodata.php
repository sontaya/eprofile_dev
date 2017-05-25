<?php
	header ("content-type: text/xml");
	$client = new SoapClient("http://personnel.dusit.ac.th/eprofile/webservices/biodata/biodataService.php?wsdl",array("trace"=>1,"exceptions"=>0));
	$data=$client->getBiodataEntry("1005-181");
 	print $data; 
?>