<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
	$client = new SoapClient("bioDataWebService.wsdl",array("trace"=>1,"exceptions"=>0));
	//$arr=array("IDCODE"=>"1005-181");
	//$data=$client->bioData($arr);

	$arr=array(
		"IDCODE"=>"",
		"EMP_ID"=>"",
		"PERSON_ID"=>"",
		"ACC_ID"=>"",
		"FNAME_TH"=>"",
		"LNAME_TH"=>"",
		"FNAME_EN"=>"",
		"LNAME_EN"=>"",
		"PERSON_TYPE"=>"",
		"CWK_MUA_MAIN"=>"",
		"CWK_MUA_SUBMAIN"=>""
	);
	
	//$data=$client->bioData($arr);
	//$data=$client->ByCriteria($arr);
	//print_r($data);
	print "<br><br>";
	//print "<pre>\n";
	//print "Request : \n".htmlspecialchars($client->__getLastRequest()) ."\n";
	//print "<br><br><br>";
	//print "Response: \n".htmlspecialchars($client->__getLastResponse())."\n";
	//print "</pre>"; 
	//print "<pre>".htmlspecialchars($client->__getLastResponse())."</pre>";
	print "<br><br>";
	$data=$client->ByCriteria($arr);
	print "<pre>".htmlspecialchars($client->__getLastResponse())."</pre>";
?>