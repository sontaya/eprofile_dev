<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	function showXML($xml){
		
	}
	$client = new SoapClient("res_fnd.wsdl");
	$catalogId = '1057-006';
	$response = $client->res_fnd($catalogId);
	echo nl2br(htmlspecialchars($response));
	
?>