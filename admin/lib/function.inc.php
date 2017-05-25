<? 
	function QueryPaging($query,$Per_Page,$Page,$query_optional){
		global $CURRENT_PAGE,$PREV,$NEXT,$TOTAL_PAGE,$Num_Rows;
		$Per_Page =$Per_Page; // แสดงหน้าละ 10 รายการ
		if(!$Page){
			$Page=1;
		}
		
			$CURRENT_PAGE = $Page;		
			$Prev_Page = $Page-1;
			$PREV = $Prev_Page;
			
			$Next_Page = $Page+1;
			$NEXT = $Next_Page;
			
			$result = mysql_query($query);
			$Page_start = ($Per_Page*$Page)-$Per_Page;
			$Num_Rows = mysql_num_rows($result);
		if($Num_Rows<=$Per_Page){
			$Num_Pages =1;
			
		}else if(($Num_Rows % $Per_Page)==0){
			$Num_Pages =($Num_Rows/$Per_Page) ;
			
		}else{ 
			$Num_Pages =($Num_Rows/$Per_Page) +1;
		}
		$Num_Pages = (int)$Num_Pages;
		$TOTAL_PAGE = $Num_Pages;
		if(($Page>$Num_Pages) || ($Page<0)){
			print "<center><b>จำนวน $Page มากกว่า $Num_Pages ยังไม่มีข้อความ<b></center>";
		}
		
		$sql_result = $query." ".$query_optional. " LIMIT $Page_start , $Per_Page";
		//echo $sql_result;
		return $sql_result;
	}

		function ReplaceSpecialChar($string){
		if ( get_magic_quotes_gpc()){
			$content = htmlspecialchars(stripslashes($string)) ;
		}else{
			$content = htmlspecialchars($string) ;
		}	
		return $content;
	}
	function DecodeSpecialChar($string){
		
		return html_entity_decode($string);
	}

	function getClientIP() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	function ThaiEachDate($vardate="") { 
		$_month_name = array("01"=>"มกราคม",  "02"=>"กุมภาพันธ์",  "03"=>"มีนาคม",  
		  "04"=>"เมษายน",  "05"=>"พฤษภาคม",  "06"=>"มิถุนายน",  
		  "07"=>"กรกฎาคม",  "08"=>"สิงหาคม",  "09"=>"กันยายน",  
		  "10"=>"ตุลาคม", "11"=>"พฤศจิกายน",  "12"=>"ธันวาคม");
		$yy =substr($vardate,0,4);$mm =substr($vardate,5,2);$dd =substr($vardate,8,2);
		$yy += 543;
		if ($yy==543){
			$dateT = "-";
		}else{
			$dateT=$dd ." ".$_month_name[$mm]."  ".$yy;
		}
			return $dateT;
	}

	function toThaiNumber($number){
		$numthai = array("๑","๒","๓","๔","๕","๖","๗","๘","๙","๐");
		$numarabic = array("1","2","3","4","5","6","7","8","9","0");
		$str = str_replace($numarabic, $numthai, $number);
		return $str;
	}

	function thainumDigit($num){
		return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),
		array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),
		$num);
	};
?>