<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	$client = new SoapClient("exp_position.wsdl");
	$catalogId = '1004-153';
	$response = $client->exp_position($catalogId);
	echo nl2br(htmlspecialchars($response));
  
?>