<?

function redirect($link){
	echo "<script language='javascript'>";
	echo "window.location='$link'; ";
	echo "</script>";
}

function jalert($msg){
	echo "<script language='javascript'>";
	echo "alert('$msg');";
	echo "</script>";
}

function reset_form($form_name){
	echo "<script language='javascript'>";
	echo "document.getElementById('$form_name').reset();";
	echo "</script>";
}

function reset_form_iframe($form_name){
	echo "<script language='javascript'>";
	echo "window.top.document.getElementById('$form_name').reset()";
	echo "</script>";
}

function save_completed($dialog_name){
	echo "<script language='javascript'>";
	echo "window.top.$(\"#{$dialog_name}\").dialog('open');";
	echo "</script>";
}

function debug($dialog_name){
	echo "<script language='javascript'>";
	echo "alert('".$dialog_name."');";
	echo "</script>";
}

function ceilNum($num){
return $temp = (ceil($num/10))*10;
}

//เขียน log
function access_log($path,$event,$user,$note){

$action = ($event == "") ? "" : $event;
$snote = ($note == "") ? "" : "[".$note."]";
rmkdir("$path",0777);
$fpt_ip = $path."/".date("Ymd").".log"; 
$ip_array = @file($fpt_ip);
$reload_dat = fopen($fpt_ip,"a");

$ip = getenv('REMOTE_ADDR');
$port = getenv('REMOTE_PORT');

$rem_addr = "AT";
$this_time = date("D d.m.Y - H:i:s")."[IP:$ip][port:$port]|$user:$action>> $snote"; //".$_SERVER['PHP_SELF']."
fwrite($reload_dat,"$rem_addr>$this_time\n");
fclose($reload_dat);
}

// จัดการ Permission
function rmkdir($path, $mode = 0777) {
    $path = rtrim(preg_replace(array("/\\\\/", "/\/{2,}/"), "/", $path), "/");
    $e = explode("/", ltrim($path, "/"));
    if(substr($path, 0, 1) == "/") {
        $e[0] = "/".$e[0];
    }
    $c = count($e);
    $cp = $e[0];
    for($i = 1; $i < $c; $i++) {
        if(!is_dir($cp) && !@mkdir($cp, $mode)) {
            return false;
        }
        $cp .= "/".$e[$i];
    }
    return @mkdir($path, $mode);
}

 function change_date($date){
	if($date != ""){
	$date=explode("/",$date);
	$new_date=$date[2]."/".$date[1]."/".$date[0];
	return $new_date;
	}
}

 function change_date3($date){
	 if($date != ""){
	$date=explode("-",$date);
	$new_date=$date[2]."/".$date[1]."/".$date[0];
	return $new_date;
	}
}

 function change_date2($date){
	 if($date != ""){
	return str_replace("-", "/", $date);
	}
}

 function change_date_thai($date){
	 if($date != ""){
	$date = str_replace("-", "/", $date);
	$date=explode("/",$date);
	$new_date=$date[2]."/".$date[1]."/".($date[0]+543);
	return $new_date; 
	}
}

function cut_first2num($num){
	return substr($num,2);
	
}

function date2_formatdb($strvalue) {
				$dd= substr($strvalue,0,2);
				$mm= substr($strvalue,3,2);
				$yy= (substr($strvalue,6,4)-543);
	
				$formatdate="$yy-$mm-$dd" ;
				return $formatdate;
				
}

function splitdate($vadate){


	if($vadate !=""){
		$dd= substr($vadate,8,2);
		$mm= substr($vadate,5,2);
		$yy= substr($vadate,0,4);


		$datesplid="$dd-$mm-$yy";
		return $datesplid;
	}

}

function randpass($numchars=8,$digits=1,$letters=1,$sensitive=0)
{
		$dig = "12345678901234567890";
		$abc = "abcdefghijklmnopqrstuvwxyz";
		if($letters == 1)
		{
		$str .= $abc;
		}
		if($sensitive == 1)
		{
		$str .= strtoupper($abc);
		}
		if($digits == 1)
		{
		$str .= $dig;
		}
		for($i=0; $i < $numchars; $i++)
		{
		$randomized .= $str{rand() % strlen($str)};
		}
		return $randomized;
}

//ฟังก์ชั่นเปลี่ยนวันที่เป็น timestamp
function change_to_timestamp1($date){//2009-12-03
	    $dd= substr($date,8,2);
		$mm= substr($date,5,2);
		$yyyy= substr($date,0,4);
		
		$mk = mktime(0, 0, 0, $mm,$dd,$yyyy);
		return $mk;
}

function change_to_timestamp2($date){//2009-12-03 23:10:15
	    $dd= substr($date,8,2);
		$mm= substr($date,5,2);
		$yyyy= substr($date,0,4);
		
		$hh=substr($date,11,2);
		$ii=substr($date,14,2);
		$ss=substr($date,17,2);
		
		$mk = mktime($hh,$ii,$ss,$mm,$dd,$yyyy);
		return $mk;
}

function change_mk_to_time($mk){
	$date=date("d-m-Y",$mk);
	return $date;
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getdays($day1,$day2){
	 $allday = round((strtotime($day2)-strtotime($day1))/(24*60*60),0);
	 if($allday < 1){
		 $allday = -1;// $allday = 1;
	 }
	 return $allday;
}
		
function getweeks($day1,$day2){
	 $allday = round((strtotime($day2)-strtotime($day1))/(24*60*60),0);
	 $allweeks = round($allday/7,0);
	 if($allweeks < 1){
		 $allweeks = 1;
	 }
	 return $allweeks;
	 
}
		
function getmonths($day1,$day2){
	$allday = round((strtotime($day2)-strtotime($day1))/(24*60*60),0);
	$allmonths = round($allday/30,0);
	if($allmonths<1){
		$allmonths=1;
	}
	return $allmonths;
}
		
function bathformat($number) {
  $numberstr = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
  $digitstr = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');

  $number = str_replace(",","",$number); //ลบ comma
  $number = explode(".",$number); //แยกจุดทศนิยมออก

  //เลขจำนวนเต็ม
  $strlen = strlen($number[0]);
  $result = '';
  for($i=0;$i<$strlen;$i++) {
    $n = substr($number[0], $i,1);
    if($n!=0) {
      if($i==($strlen-1) AND $n==1){ $result .= 'เอ็ด'; }
      elseif($i==($strlen-2) AND $n==2){ $result .= 'ยี่'; }
      elseif($i==($strlen-2) AND $n==1){ $result .= ''; }
      else{ $result .= $numberstr[$n]; }
      $result .= $digitstr[$strlen-$i-1];
    }
  }
  
  //จุดทศนิยม
  $strlen = strlen($number[1]);
  if ($strlen>2) { //ทศนิยมมากกว่า 2 ตำแหน่ง คืนค่าเป็นตัวเลข
    $result .= 'จุด';
    for($i=0;$i<$strlen;$i++) {
      $result .= $numberstr[(int)$number[1][$i]];
    }
  } else { //คืนค่าเป็นจำนวนเงิน (บาท)
    $result .= 'บาท';
    if ($number[1]=='0' OR $number[1]=='00' OR $number[1]=='') {
      $result .= 'ถ้วน';
    } else {
      //จุดทศนิยม (สตางค์)
      for($i=0;$i<$strlen;$i++) {
        $n = substr($number[1], $i,1);
        if($n!=0){
          if($i==($strlen-1) AND $n==1){$result .= 'เอ็ด';}
          elseif($i==($strlen-2) AND $n==2){$result .= 'ยี่';}
          elseif($i==($strlen-2) AND $n==1){$result .= '';}
          else{ $result .= $numberstr[$n];}
          $result .= $digitstr[$strlen-$i-1];
        }
      }
      $result .= 'สตางค์';
    }
  }
  return $result;
}

 function  removecomma($value)
{
	   return str_replace(",", "", $value);
}


function birthday($birthday)
{ 
	$age[0] = "";
	$age[1] = "";
	if($birthday != ""){
	list($year,$month,$day) = explode("-",$birthday);
	$year_diff = (int)date("Y") - (int)$year;
	$month_diff = (int)date("m") - (int)($month);
	if($month_diff < 0){
		$year_diff -= 1;
		$month_diff += 12;
	}
	$age[0] = $year_diff;
	$age[1] = $month_diff;
	}
	return $age;
}

function auto_increment($field,$tbl){
	global $conn;
	$sql =  "SELECT ".$field." FROM ".$tbl." ORDER BY ".$field." DESC";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	if($row[$field] == ""){
		$num = 1;
	}else{
		$num = $row[$field] + 1;
	}
	return $num;
}

function get_emp_id($id,$tbl){
	global $conn;
	$sql =  "SELECT EMP_ID FROM ".$tbl." WHERE EMP_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['EMP_ID'];
}

function get_department($id,$tbl){
	global $conn;
	$sql =  "SELECT NAME_FACULTY FROM ".$tbl." WHERE CODE_FACULTY = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['NAME_FACULTY'];
}

function get_department2($id,$tbl1,$tbl2){
	global $conn;
	$sql =  "SELECT CWK_MUA_MAIN FROM ".$tbl1." WHERE EMP_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	
	$sql =  "SELECT NAME_FACULTY FROM ".$tbl2." WHERE CODE_FACULTY = '".$row["CWK_MUA_MAIN"]."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row2 = oci_fetch_array($stid, OCI_BOTH);

	return $row2['NAME_FACULTY'];
}

function get_department_sub($id,$tbl){
	global $conn;
	$sql =  "SELECT NAME_DEPARTMENT_SECTION FROM ".$tbl." WHERE CODE_DEPARTMENT_SECTION = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['NAME_DEPARTMENT_SECTION'];
}


function get_stafftype($id,$tbl1,$tbl2){
	global $conn;
	$sql =  "SELECT CWK_MUA_EMP_TYPE FROM ".$tbl1." WHERE EMP_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	
	$sql =  "SELECT STAFFTYPE_NAME FROM ".$tbl2." WHERE STAFFTYPE_ID = '".$row["CWK_MUA_EMP_TYPE"]."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row2 = oci_fetch_array($stid, OCI_BOTH);

	return $row2['STAFFTYPE_NAME'];
}

function get_stafftypesub($id,$tbl1,$tbl2){
	global $conn;
	$sql =  "SELECT CWK_MUA_EMP_SUBTYPE FROM ".$tbl1." WHERE EMP_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	
	$sql =  "SELECT SUBSTAFFTYPE_NAME FROM ".$tbl2." WHERE SUBSTAFFTYPE_ID = '".$row["CWK_MUA_EMP_SUBTYPE"]."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row2 = oci_fetch_array($stid, OCI_BOTH);
	list($d1,$d2) = explode(" ",$row2['SUBSTAFFTYPE_NAME']);
	return $d1;
}


function get_position($id1,$id2){
	global $conn;
	$sql =  "SELECT POSITION_NAME_TH FROM  ".TB_REF_POSITION."  WHERE POSITION_ID = '".$id1."' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	$position = $row['POSITION_NAME_TH'];
	switch($position){
		case "อาจารย์": $p = "อาจารย์"; break;	
		case "ผู้ช่วยศาสตราจารย์": $p = "ผศ."; break;	
		case "รองศาสตราจารย์": $p = "รศ."; break;	
		case "ศาสตราจารย์": $p = "ศ."; break;	
	}	
	$sql =  "SELECT STAFF_LEV_NAME FROM  ".TB_REF_STAFF_LEV." WHERE STAFF_LEV_ID = '".$id2."' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	$level = $row['STAFF_LEV_NAME'];
	return $p." ".$level;
}

function get_position2($id1,$tbl){
	global $conn;
	$sql =  "SELECT * FROM  $tbl  WHERE CODE = '".$id1."' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	return $row["POSITION"];
	
}

function get_birthday($id,$tbl,$showthai=true){
	global $conn;
	$sql =  "SELECT BIO_BIRTHDAY FROM ".$tbl." WHERE EMP_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	if($showthai){
		return change_date_thai($row['BIO_BIRTHDAY']);
	}else{
		return $row['BIO_BIRTHDAY'];	
	}
}

function get_person_id($id,$tbl){
	global $conn;
	$sql =  "SELECT PERSON_ID FROM ".$tbl." WHERE EMP_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['PERSON_ID'];
}


function get_month($month){
	$month = $month*1;
	switch($month){
		case "1": $m = "ม.ค."; break;	
		case "2": $m = "ก.พ."; break;	
		case "3": $m = "มี.ค."; break;	
		case "4": $m = "เม.ย."; break;	
		case "5": $m = "พ.ค."; break;	
		case "6": $m = "มิ.ย."; break;	
		case "7": $m = "ก.ค."; break;	
		case "8": $m = "ส.ค."; break;	
		case "9": $m = "ก.ย."; break;	
		case "10": $m = "ต.ค."; break;	
		case "11": $m = "พ.ย."; break;	
		case "12": $m = "ธ.ค."; break;	
	}
	return $m;
}

function get_month_full($month){
	$month = $month*1;
	switch($month){
		case "1": $m = "มกราคม"; break;	
		case "2": $m = "กุมภาพันธ์"; break;	
		case "3": $m = "มีนาคม"; break;	
		case "4": $m = "เมษายน"; break;	
		case "5": $m = "พฤษภาคม"; break;	
		case "6": $m = "มิถุนายน"; break;	
		case "7": $m = "กรกฎาคม"; break;	
		case "8": $m = "สิงหาคม"; break;	
		case "9": $m = "กันยายน"; break;	
		case "10": $m = "ตุลาคม"; break;	
		case "11": $m = "พฤศจิกายน"; break;	
		case "12": $m = "ธันวาคม"; break;	
	}
	return $m;
}

function get_name($id,$tbl){
	global $conn;
	$sql =  "SELECT BIO_TITLE_TH,BIO_FNAME_TH,BIO_LNAME_TH FROM ".$tbl." WHERE EMP_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	/*switch($row['BIO_TITLE_TH']){
			case "นาย": $title = "นาย"; break;	
			case "นาง": $title = "นาง"; break;	
			case "3": $title = "น.ส."; break;	
		}*/
	$name = $row['BIO_TITLE_TH']." ".$row['BIO_FNAME_TH']." ".$row['BIO_LNAME_TH'];
	return $name;
}

function get_fullname($id) {
  global $conn;
  // check ตำแหน่งทางวิชาการ
  $sql = "SELECT POSITION_NAME_TH FROM  " . TB_REF_POSITION . "  
              WHERE POSITION_NAME_ENG = 'ตำแหน่งทางวิชาการ' AND POSITION_ID IN (SELECT CWK_MUA_VPOS FROM  " . TB_CURRENT_WORK_TAB . "  WHERE  EMP_ID = '{$id}' ) 
             ";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_BOTH);

  if ($row['POSITION_NAME_TH'] != "") {
    $title = $row['POSITION_NAME_TH'] . " ";
  }

  $sql = "SELECT EDU_LEVEL FROM  SDU_EDUCATION_TAB 
          WHERE  EMP_ID = '{$id}' AND EDU_LEVEL = 80
          ";

  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_BOTH);
  if ($row['EDU_LEVEL'] == 80) {
    $title .= "ดร. ";
  }

  $sql = "SELECT BIO_TITLE_TH,BIO_FNAME_TH,BIO_LNAME_TH FROM SDU_BIODATA_TAB WHERE EMP_ID = '" . $id . "'";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_BOTH);

  if ($title == "") {
    $title = $row['BIO_TITLE_TH'];
  }
  $name = $title . " " . $row['BIO_FNAME_TH'] . " " . $row['BIO_LNAME_TH'];
  return $name;
}

function get_name2($id,$tbl){
	global $conn;
	$sql =  "SELECT BIO_TITLE_TH,BIO_FNAME_TH,BIO_LNAME_TH FROM ".$tbl." WHERE EMP_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	$name = $row['BIO_FNAME_TH']." ".$row['BIO_LNAME_TH'];
	return $name;
}
 
function type_name($id){
		$name="";
		switch($id){
			case "1": $name = "เอกสารประกอบการสอน"; break;	
			case "2": $name = "ตำรา"; break;	
			case "3": $name = "หนังสือ"; break;	
			case "4": $name = "ผลงานวิจัย"; break;	
			case "5": $name = "บทความ"; break;	
			case "6": $name = "ผลงานวิชาการลักษณะอื่นๆ"; break;	
			
		}
		return $name;
	}
	
function get_edu_level($id){
		switch ($id){
			case "1": $txt = "ปริญญาโท"; break;
			case "2": $txt = "ปริญญาเอก"; break;
			case "3": $txt = "ปริญญาโท - เอก"; break;
		}
		return $txt;
	}
	
function get_edu_major($id,$tbl){
	global $conn;
	$sql =  "SELECT PROGRAM_NAME FROM ".$tbl." WHERE PROGRAM_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['PROGRAM_NAME'];
}

function get_edu_major2($id,$tbl){
	global $conn;
	$sql =  "SELECT ISCED_NAME_TH FROM ".$tbl." WHERE ISCED_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['ISCED_NAME_TH'];
}

function get_expire_old($ref,$emp_id,$tbl){
	global $conn;
	$sql =  "SELECT SCH_END_DATE FROM ".$tbl." WHERE SCH_ORDER_NO = '".$ref."' AND EMP_ID = '".$emp_id."' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return change_date_thai($row['SCH_END_DATE']);
}

function get_pay_type($id){
	switch ($id){
			case "1": $txt = "คืนโดยการทำงานชดใช้"; break;
			case "2": $txt = "คืนโดยจำนวนเงินชดใช้"; break;
			case "3": $txt = "คืนทั้งเงินและวันที่ทำงานชดใช้"; break;
		}
		return $txt;
}

function get_tumbon_name($id,$tbl){
	global $conn;
	$sql =  "SELECT NAME_REF_TUMBON FROM ".$tbl." WHERE CODE_REF_TUMBON = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['NAME_REF_TUMBON'];
}

function get_amphur_name($id,$tbl){
	global $conn;
	$sql =  "SELECT NAME_REF_AMPHUR FROM ".$tbl." WHERE CODE_REF_AMPHUR = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['NAME_REF_AMPHUR'];
}

function get_province_name($id,$tbl){
	global $conn;
	$sql =  "SELECT NAME_REF_PROVINCE FROM ".$tbl." WHERE CODE_REF_PROVINCE = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['NAME_REF_PROVINCE'];
}

function get_nation_name($id,$tbl){
	global $conn;
	$sql =  "SELECT NATION_NAME_TH FROM ".$tbl." WHERE NATION_ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['NATION_NAME_TH'];
}

function type_seminar($id,$tbl){
	global $conn;
	$sql =  "SELECT NAME_TRAINTYPE FROM ".$tbl." WHERE CODE_TRAINTYPE = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['NAME_TRAINTYPE'];
	}
	
function get_education($id,$tbl1,$tbl2){
	global $conn;
	$sql =  "SELECT EDU_LEVEL FROM ".$tbl1." WHERE EMP_ID = '".$id."' ORDER BY EDU_LEVEL DESC";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	
	$sql =  "SELECT LEV_NAME_TH FROM ".$tbl2." WHERE LEV_ID = '".$row["EDU_LEVEL"]."'";
	//print $sql;
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row2 = oci_fetch_array($stid, OCI_BOTH);

	return $row2['LEV_NAME_TH'];
}

function get_salary_source($id,$tbl){
	global $conn;
	$sql =  "SELECT NAME_SALARY_SOURCE FROM ".$tbl." WHERE CODE_SALARY_SOURCE = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['NAME_SALARY_SOURCE'];
}

function get_salary_ex($id,$tbl){
	global $conn;
	$sql =  "SELECT ABBREVIATION FROM ".$tbl." WHERE ID = '".$id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);

	return $row['ABBREVIATION'];
}


function count_day($date,$total){
	if($date != "" and ($total != "" or $total != 0)){
		list($y,$m,$d) = explode("-",$date);
		return $temp = change_date_thai(date("Y-m-d", strtotime("+$total days",mktime(0,0,0,$m,$d,$y))));
	}
}

function get_main_sector($emp_id){
global $conn;
	$sql =  "SELECT CWK_MUA_MAIN,NAME_FACULTY FROM ".TB_CURRENT_WORK_TAB."
             LEFT JOIN ".TB_REF_DEPARTMENT."
             ON CWK_MUA_MAIN = CODE_FACULTY
             WHERE EMP_ID = '{$emp_id}'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	return $row['NAME_FACULTY'];
}

function get_sub_sector($emp_id){
  global $conn;
	$sql =  "SELECT CWK_MUA_MAIN,NAME_DEPARTMENT_SECTION FROM ".TB_CURRENT_WORK_TAB."
             LEFT JOIN ".TB_REF_DEPARTMENT_SUB."
             ON CWK_MUA_SUBMAIN = CODE_DEPARTMENT_SECTION
             WHERE EMP_ID = '{$emp_id}'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	return $row['NAME_DEPARTMENT_SECTION'];
}

function get_group($emp_id){
global $conn;
	$sql =  "SELECT CWK_MUA_MAIN,NAME_DEPARTMENT_GROUP FROM ".TB_CURRENT_WORK_TAB."
             LEFT JOIN ".TB_REF_DEPARTMENT_GROUP."
             ON CWK_MUA_WORK_GROUP = CODE_DEPARTMENT_GROUP
             WHERE EMP_ID = '{$emp_id}'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	return $row['NAME_DEPARTMENT_GROUP'];
}

function debug_view ( $what ) {
    echo '<pre>';
    if ( is_array( $what ) )  {
        print_r ( $what );
    } else {
        var_dump ( $what );
    }
    echo '</pre>';
}
?>