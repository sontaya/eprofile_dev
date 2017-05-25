<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	$client = new SoapClient("edu_his.wsdl");
	$catalogId = '2010-066';
	$response = $client->edu_his($catalogId);
	echo nl2br(htmlspecialchars($response));
  
?>