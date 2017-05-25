<?

function chk_null($text){
	if($text==""){
		$text="";
	}
	return $text;
}

function arrayToObject($d){
		if (is_object($d)){
			$d = get_object_vars($d);
		}
		if (is_array($d)) {
			return array_map(__FUNCTION__, $d);
		}
		else {
			return $d;
		}
}

function current_work_tab($empId,$conn){
	$sql = "SELECT SDU_CURRENT_WORK_TAB.*, SDU_REF_STATUS_EXT.STATUS_NAME AS CWK_STATUS_NAME
			FROM SDU_CURRENT_WORK_TAB , SDU_REF_STATUS_EXT 
			WHERE SDU_REF_STATUS_EXT.STATUS_ID = SDU_CURRENT_WORK_TAB.CWK_STATUS AND 
				  SDU_CURRENT_WORK_TAB.EMP_ID = '".$empId."'";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	$row = oci_fetch_array($stid,OCI_BOTH);
	return $row;
}

function sdu_education_tab($empId,$conn){
	$sql="SELECT * FROM SDU_EDUCATION_TAB WHERE EMP_ID = '".$empId."' ORDER BY EDU_YEAR DESC";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	while($data=oci_fetch_array($stid,OCI_BOTH)){
		$row[]=$data;
	}
	return $row;
}

function edu_evl($conn){
	$sql="SELECT * FROM SDU_REF_LEV";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	while($data=oci_fetch_array($stid,OCI_BOTH)){
		$row[$data["LEV_ID"]]=$data;
	}
	return $row;
}

function department($conn){
	$sql="SELECT * FROM SDU_REF_DEPARTMENT";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	while($data=oci_fetch_array($stid,OCI_BOTH)){
		$row[$data["CODE_FACULTY"]]=$data;
	}
	return $row;
}

function department_sub($conn){
	$sql="SELECT * FROM SDU_REF_DEPARTMENT_SUB";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	while($data=oci_fetch_array($stid,OCI_BOTH)){
		$row[$data["CODE_DEPARTMENT_SECTION"]]=$data;
	}
	return $row;
}

function position($conn){
	$sql="SELECT * FROM SDU_REF_POSITION";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	while($data=oci_fetch_array($stid,OCI_BOTH)){
		$row[$data["POSITION_ID"]]=$data;
	}
	return $row;
}

function nation($conn){
	$sql="SELECT * FROM SDU_REF_NATION";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	while($data=oci_fetch_array($stid,OCI_BOTH)){
		$row[$data["NATION_ID"]]=$data;
	}
	return $row;
}

function bioData($arr=array()){
		include("connectDB.php");
		$position=position($conn);
		$edu_evl=edu_evl($conn);
		$department=department($conn);
		$department_sub=department_sub($conn);
		$nation=nation($conn);
		
		$input=arrayToObject($arr);
		$sql = "SELECT SDU_BIODATA_TAB.* 
				FROM SDU_BIODATA_TAB 
				WHERE SDU_BIODATA_TAB.EMP_ID = '".$input["IDCODE"]."'";
		$stid = oci_parse($conn,$sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);

		$work = current_work_tab($row["EMP_ID"],$conn);
		$edu = sdu_education_tab($row["EMP_ID"],$conn);
		//$edu=new stdClass;
		//$edu->EDU=array("EDU_DATA"=>array("EDU_LEVER"=>'www',"EDU_LEVER2"=>"dd"));
		
		$return =array(
			"return"=>array(
				array(
					"EMP_ID"=>chk_null($row["EMP_ID"]),
					"BIO_TITLE_TH2"=>chk_null($row["BIO_TITLE_TH2"]),
					"PERSON_ID"=>chk_null($row["PERSON_ID"]),
					"BIO_BANK_ACC_ID"=>chk_null($row["BIO_BANK_ACC_ID"]),
					"BIO_TITLE_TH"=>chk_null($row["BIO_TITLE_TH"]),
					"BIO_TITLE_EN"=>chk_null($row["BIO_TITLE_EN"]),
					"BIO_FNAME_TH"=>chk_null($row["BIO_FNAME_TH"]),
					"BIO_LNAME_TH"=>chk_null($row["BIO_LNAME_TH"]),
					"BIO_FNAME_EN"=>chk_null($row["BIO_FNAME_EN"]),
					"BIO_LNAME_EN"=>chk_null($row["BIO_LNAME_EN"]),
					"BIO_MNAME_EN"=>chk_null($row["BIO_MNAME_EN"]),
					"CWK_MUA_VPOS"=>chk_null($position[$work["CWK_MUA_VPOS"]]["POSITION_NAME_TH"]),
					"BIO_NATION2"=>chk_null($row["BIO_NATION2"]),
					"BIO_NATION1"=>chk_null($row["BIO_NATION1"]),
					"CWK_MUA_MAIN"=>chk_null($work["CWK_MUA_MAIN"]),
					"CWK_MUA_SUBMAIN"=>chk_null($work["CWK_MUA_SUBMAIN"]),
					"CWK_MUA_MAIN_NAME"=>chk_null($department[$work["CWK_MUA_MAIN"]]["NAME_FACULTY"]),
					"CWK_MUA_SUBMAIN_NAME"=>chk_null($department_sub[$work["CWK_MUA_SUBMAIN"]]["NAME_DEPARTMENT_SECTION"]),
					"CEK_DSU_EDU_CENTER"=>chk_null($work["CEK_DSU_EDU_CENTER"]),
					"BIO_MOBILE_1"=>chk_null($row["BIO_MOBILE_1"]),
					"BIO_MOBILE_2"=>chk_null($row["BIO_MOBILE_2"]),
					"BIO_EMAIL1"=>chk_null($row["BIO_EMAIL1"]),
					"BIO_EMAIL2"=>chk_null($row["BIO_EMAIL2"]),
					"CWK_STATUS_NAME"=>chk_null($work["CWK_STATUS_NAME"]),
				)
			)
		);
		/*
		for($i=1;$i<=3;$i++){
			$text[0] = new SoapVar("1234",XSD_STRING,null,null,"EDU_LEVER");
			$text[1] = new SoapVar("123433",XSD_STRING,null,null,"EDU_LEVER2");
			$edu_xml[] = new SoapVar($text,SOAP_ENC_OBJECT,null,null,"EDU_DATA");
		}
		*/
		
		foreach($edu as $value){
			$text[0] = new SoapVar(chk_null($value["EMP_ID"]),XSD_STRING,null,null,"EMP_ID");
			$text[1] = new SoapVar(chk_null($value["EDU_ID"]),XSD_STRING,null,null,"EDU_ID");
			$text[2] = new SoapVar(chk_null($edu_evl[$value["EDU_LEVEL"]]["LEV_NAME_TH"]),XSD_STRING,null,null,"EDU_LEVEL");
			$text[3] = new SoapVar(chk_null($value["EDU_NAME"]),XSD_STRING,null,null,"EDU_NAME");
			$text[4] = new SoapVar(chk_null($value["EDU_NAME_SHORT"]),XSD_STRING,null,null,"EDU_NAME_SHORT");
			$text[5] = new SoapVar(chk_null($value["EDU_GPA"]),XSD_STRING,null,null,"EDU_GPA");
			$text[6] = new SoapVar(chk_null($value["EDU_PROGRAM"]),XSD_STRING,null,null,"EDU_PROGRAM");
			$text[7] = new SoapVar(chk_null($value["EDU_YEAR"]),XSD_STRING,null,null,"EDU_YEAR");
			$text[8] = new SoapVar(chk_null($value["EDU_MAJOR"]),XSD_STRING,null,null,"EDU_MAJOR");
			$text[9] = new SoapVar(chk_null($value["EDU_DISCIPLINE"]),XSD_STRING,null,null,"EDU_DISCIPLINE");
			$text[10] = new SoapVar(chk_null($value["EDU_FROM"]),XSD_STRING,null,null,"EDU_FROM");
			$text[11] = new SoapVar(chk_null($nation[$value["EDU_COUNTRY"]]["NATION_NAME_TH"]),XSD_STRING,null,null,"EDU_COUNTRY");
			$edu_xml[] = new SoapVar(chk_null($text),SOAP_ENC_OBJECT,null,null,"EDU_DATA");
		}
		if(count($edu)>0){
			$return["return"][0]["EDU"] = new SoapVar($edu_xml,SOAP_ENC_OBJECT,null,null,"EDU");
		}
		
		return $return;
}

function ByCriteria($arr=array()){
	include("connectDB.php");
	/*
	$set_type["3"]=array("1","1");
	$set_type["4"]=array("2","2");
	$set_type["6"]=array("10");
	*/
	$set_type["3"]=array("1");
	$set_type["4"]=array("2");
	$set_type["6"]=array("10");
	
	
	
	$edu_evl=edu_evl($conn);
	$department=department($conn);
	$department_sub=department_sub($conn);
	$position=position($conn);
	
	$input=arrayToObject($arr);
	
	if($input["IDCODE"]!=""){
		$sql.=" AND SDU_BIODATA_TAB.EMP_ID LIKE '".$input["IDCODE"]."%'";
	}
	if($input["EMP_ID"]!=""){

			$sql.=" AND SDU_BIODATA_TAB.EMP_ID LIKE '".$input["EMP_ID"]."%'";
	}
	if($input["PERSON_ID"]!=""){

			$sql.=" AND SDU_BIODATA_TAB.PERSON_ID LIKE '".$input["PERSON_ID"]."%'";
	}
	if($input["ACC_ID"]!=""){
			$sql.=" AND SDU_BIODATA_TAB.BIO_BANK_ACC_ID LIKE '".$input["ACC_ID"]."%'";	
	}
	if($input["FNAME_TH"]!=""){
			$sql.=" AND SDU_BIODATA_TAB.BIO_FNAME_TH LIKE '".$input["FNAME_TH"]."%'";
	}
	if($input["LNAME_TH"]!=""){
			$sql.=" AND BIO_LNAME_TH LIKE '".$input["LNAME_TH"]."%'";
	}
	if($input["FNAME_EN"]!=""){
			$sql.=" AND SDU_BIODATA_TAB.BIO_FNAME_EN LIKE '".$input["FNAME_EN"]."%'";		
	}
	if($input["LNAME_EN"]!=""){

			$sql.=" AND SDU_BIODATA_TAB.BIO_LNAME_EN LIKE '".$input["LNAME_EN"]."%'";
	}
	
	if($input["PERSON_TYPE"]!="" and $input["PERSON_TYPE"]!="0"){
		//$sql.=" AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE = ".$input["PERSON_TYPE"]."";
		/*
		if($input["PERSON_TYPE"]!="6"){
			$sql.=" AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE = '".$set_type[$input["PERSON_TYPE"]][0]."' AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_SUBTYPE='".$set_type[$input["PERSON_TYPE"]][1]."'";
		}
		else{
			$sql.=" AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE = '".$set_type[$input["PERSON_TYPE"]]."'";
		}
		*/
		
		if($input["PERSON_TYPE"]=="3"){
			$sql.=" AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_SUBTYPE='".$set_type[$input["PERSON_TYPE"]][0]."'";
		}elseif($input["PERSON_TYPE"]=="4"){
			$sql.=" AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_SUBTYPE='".$set_type[$input["PERSON_TYPE"]][0]."'";
		}elseif($input["PERSON_TYPE"]=="6"){
			$sql.=" AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE = '".$set_type[$input["PERSON_TYPE"]]."'";
		}
		
		
		$join=1;
	}
	if($input["CWK_MUA_MAIN"]!=""){
		$sql.=" AND SDU_CURRENT_WORK_TAB.CWK_MUA_MAIN = ".$input["CWK_MUA_MAIN"]."";
		$join=1;
	}
	if($input["CWK_MUA_SUBMAIN"]!=""){
		$sql.=" AND SDU_CURRENT_WORK_TAB.CWK_MUA_SUBMAIN = ".$input["CWK_MUA_SUBMAIN"]."";
		$join=1;
	}
	
	$sql=str_replace("*","",$sql);
	//$sql_data="SELECT * FROM SDU_BIODATA_TAB WHERE 1=1 ".$sql;
	//if($join==1){
		/*
		$sql_data="	SELECT SDU_BIODATA_TAB.* 
					FROM SDU_BIODATA_TAB 
						LEFT JOIN SDU_CURRENT_WORK_TAB ON SDU_BIODATA_TAB.EMP_ID=SDU_CURRENT_WORK_TAB.EMP_ID 
					WHERE 1=1 ".$sql;
		*/
		$sql_data="	SELECT SDU_BIODATA_TAB.* 
					FROM SDU_BIODATA_TAB, SDU_CURRENT_WORK_TAB 
					WHERE   SDU_BIODATA_TAB.EMP_ID=SDU_CURRENT_WORK_TAB.EMP_ID  
							AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE <> '7' ".$sql;
	//} 
	
	//AND SDU_CURRENT_WORK_TAB.CWK_STATUS IN ('01','05')
	
	//$sql_data=str_replace("*","",$sql_data);
	//print $sql_data;
	$stid = oci_parse($conn,$sql_data);
	oci_execute($stid);
	
	while($row = oci_fetch_array($stid,OCI_BOTH)){
		$work = current_work_tab($row["EMP_ID"],$conn);
		
		$text[0] = new SoapVar(chk_null($row["EMP_ID"]),XSD_STRING,null,null,"EMP_ID");
		$text[1] = new SoapVar(chk_null($row["BIO_TITLE_TH2"]),XSD_STRING,null,null,"BIO_TITLE_TH2");
		$text[2] = new SoapVar(chk_null($row["PERSON_ID"]),XSD_STRING,null,null,"PERSON_ID");
		$text[3] = new SoapVar(chk_null($row["BIO_BANK_ACC_ID"]),XSD_STRING,null,null,"BIO_BANK_ACC_ID");
		$text[4] = new SoapVar(chk_null($row["BIO_TITLE_TH"]),XSD_STRING,null,null,"BIO_TITLE_TH");
		$text[5] = new SoapVar(chk_null($row["BIO_TITLE_EN"]),XSD_STRING,null,null,"BIO_TITLE_EN");
		$text[6] = new SoapVar(chk_null($row["BIO_FNAME_TH"]),XSD_STRING,null,null,"BIO_FNAME_TH");
		$text[7] = new SoapVar(chk_null($row["BIO_LNAME_TH"]),XSD_STRING,null,null,"BIO_LNAME_TH");
		$text[8] = new SoapVar(chk_null($row["BIO_FNAME_EN"]),XSD_STRING,null,null,"BIO_FNAME_EN");
		$text[9] = new SoapVar(chk_null($row["BIO_LNAME_EN"]),XSD_STRING,null,null,"BIO_LNAME_EN");
		$text[10] = new SoapVar(chk_null($row["BIO_MNAME_EN"]),XSD_STRING,null,null,"BIO_MNAME_EN");			
		$text[11] = new SoapVar(chk_null($position[$work["CWK_MUA_VPOS"]]["POSITION_NAME_TH"]),XSD_STRING,null,null,"CWK_MUA_VPOS");
		$text[12] = new SoapVar(chk_null($row["BIO_NATION2"]),XSD_STRING,null,null,"BIO_NATION2");
		$text[13] = new SoapVar(chk_null($row["BIO_NATION1"]),XSD_STRING,null,null,"BIO_NATION1");			
		$text[14] = new SoapVar(chk_null($work["CWK_MUA_SUBMAIN"]),XSD_STRING,null,null,"CWK_MUA_SUBMAIN");
		$text[15] = new SoapVar(chk_null($row["CEK_DSU_EDU_CENTER"]),XSD_STRING,null,null,"CEK_DSU_EDU_CENTER");
		$text[16] = new SoapVar(chk_null($row["BIO_MOBILE_1"]),XSD_STRING,null,null,"BIO_MOBILE_1");
		$text[17] = new SoapVar(chk_null($row["BIO_MOBILE_2"]),XSD_STRING,null,null,"BIO_MOBILE_2");
		$text[18] = new SoapVar(chk_null($row["BIO_EMAIL1"]),XSD_STRING,null,null,"BIO_EMAIL1");
		$text[19] = new SoapVar(chk_null($row["BIO_EMAIL2"]),XSD_STRING,null,null,"BIO_EMAIL2");
		$text[20] = new SoapVar(chk_null($work["CWK_MUA_MAIN"]),XSD_STRING,null,null,"CWK_MUA_MAIN");
		$text[21] = new SoapVar(chk_null($department[$work["CWK_MUA_MAIN"]]["NAME_FACULTY"]),XSD_STRING,null,null,"CWK_MUA_MAIN_NAME");
		$text[22] = new SoapVar(chk_null($department_sub[$work["CWK_MUA_SUBMAIN"]]["NAME_DEPARTMENT_SECTION"]),XSD_STRING,null,null,"CWK_MUA_SUBMAIN_NAME");
		$text[23] = new SoapVar(chk_null($work["CWK_STATUS_NAME"]),XSD_STRING,null,null,"CWK_STATUS_NAME");
		unset($edu_xml);
		$edu = sdu_education_tab($row["EMP_ID"],$conn);
		foreach($edu as $value){
			$text_edu[0] = new SoapVar(chk_null($value["EMP_ID"]),XSD_STRING,null,null,"EMP_ID");
			$text_edu[1] = new SoapVar(chk_null($value["EDU_ID"]),XSD_STRING,null,null,"EDU_ID");
			$text_edu[2] = new SoapVar(chk_null($value["EDU_LEVEL"]),XSD_STRING,null,null,"EDU_LEVEL");
			$text_edu[3] = new SoapVar(chk_null($value["EDU_NAME"]),XSD_STRING,null,null,"EDU_NAME");
			$text_edu[4] = new SoapVar(chk_null($value["EDU_NAME_SHORT"]),XSD_STRING,null,null,"EDU_NAME_SHORT");
			$text_edu[5] = new SoapVar(chk_null($value["EDU_GPA"]),XSD_STRING,null,null,"EDU_GPA");
			$text_edu[6] = new SoapVar(chk_null($value["EDU_PROGRAM"]),XSD_STRING,null,null,"EDU_PROGRAM");
			$text_edu[7] = new SoapVar(chk_null($value["EDU_YEAR"]),XSD_STRING,null,null,"EDU_YEAR");
			$text_edu[8] = new SoapVar(chk_null($value["EDU_MAJOR"]),XSD_STRING,null,null,"EDU_MAJOR");
			$text_edu[9] = new SoapVar(chk_null($value["EDU_DISCIPLINE"]),XSD_STRING,null,null,"EDU_DISCIPLINE");
			$text_edu[10] = new SoapVar(chk_null($value["EDU_FROM"]),XSD_STRING,null,null,"EDU_FROM");
			$text_edu[11] = new SoapVar(chk_null($value["EDU_COUNTRY"]),XSD_STRING,null,null,"EDU_COUNTRY");
			$edu_xml[] = new SoapVar($text_edu,SOAP_ENC_OBJECT,null,null,"EDU_DATA");
		}
		
		if(count($edu_xml)>0){
			//$text[17]  = new SoapVar($edu_xml,SOAP_ENC_OBJECT,null,null,"EDU");
		}
		$person_xml[] = new SoapVar($text,SOAP_ENC_OBJECT,null,null,"return");
	}
	//}
	//$return["return"][0]= new SoapVar($person_xml,SOAP_ENC_OBJECT,null,null,"return");
	//$return["return"][0]=$person_xml;
	return $person_xml;
}

//$d=ByCriteria(array("FNAME_TH"=>"เบญ*"));
//print_r($d);
	
	ini_set('soap.wsdl_cache_enabled',0);
	ini_set('soap.wsdl_cache_ttl',0);
	$server = new SoapServer("bioDataWebService.wsdl");
	$server->addFunction("bioData");
	$server->addFunction("ByCriteria");
	$server->handle();
	

?>