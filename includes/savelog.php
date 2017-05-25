<?php
	@session_start();
	
	
	function save_sql_log($sql,$user) {
		$file_name = date("Y-m") . ".txt";
		
		$fh = fopen($file_name,"a+");
		
		$date_time = date("Y-m-d H:i:s");
		
		fwrite($fh,"[{$date_time}] [$user] [$sql]\r\n");
		
		fclose($fh);
	}
?>