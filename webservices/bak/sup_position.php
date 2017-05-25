<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	$client = new SoapClient("sup_position.wsdl");
	$catalogId = '2010-066';
	$response = $client->sup_position($catalogId);
	echo nl2br(htmlspecialchars($response));
  
?>