<?php
	@session_start();
	
	// Check user online session
	
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	
	echo session_id();
	
?>