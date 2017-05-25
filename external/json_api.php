<?php

	header('content-type: application/json; charset=utf-8');
	header("access-control-allow-origin: *");

	$conn = oci_connect('SDPERSON','PERSON','10.202.1.112/RSDUE2M','AL32UTF8');
	if($_GET['all']){
		getAll($conn);
	}else if($_GET['faculty']){
		if($_GET['sub_staff']){
			echo getByFaculty($conn,$_GET['faculty'],$_GET['sub_staff']);
		}else{
			echo getByFaculty($conn,$_GET['faculty']);	
		}
		
	}else if($_GET['person']){
		echo getByPerson($conn,$_GET['person']);
	}else{
		index();
	}

	
	function index(){
		echo 'GET ALL : json_api.php?all=all ; Sample : <small><a href="http://personnel.dusit.ac.th/eprofile/external/json_api.php?all=all">http://personnel.dusit.ac.th/eprofile/external/json_api.php?all=all</a></small><br/>';
		echo 'GET BY FACULTY : json_api.php?faculty=CODE_FACULTY ; Sample : <small><a href="http://personnel.dusit.ac.th/eprofile/external/json_api.php?faculty=05">http://personnel.dusit.ac.th/eprofile/external/json_api.php?faculty=05</a></small><br/>';
		echo 'GET BY PERSON : json_api.php?person=CODE_PERSON ; Sample : <small><a href="http://personnel.dusit.ac.th/eprofile/external/json_api.php?person=2023-016">http://personnel.dusit.ac.th/eprofile/external/json_api.php?person=2023-016</a></small><br/>';
	}
	
	function getAll($conn){
		$sql = "SELECT * FROM UOC_GENERAL_PROFILE";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = array("PERSON_CODE"=>$rdep["PERSON_CODE"],"CODE_PERSON"=>$rdep["CODE_PERSON"],"NAME_PRENAME_THA"=>$rdep["NAME_PRENAME_THA"],"FIRST_NAME_THA"=>$rdep["FIRST_NAME_THA"],"LAST_NAME_THA"=>$rdep["LAST_NAME_THA"],"NAME_FACULTY"=>$rdep["NAME_FACULTY"],"CODE_DEPARTMENT"=>$rdep["CODE_DEPARTMENT"]);
			}
			
		echo json_encode($data);
	}

	function getByFaculty($conn,$faculty,$sub_staff='1'){
		$sql = "SELECT * FROM UOC_GENERAL_PROFILE WHERE CODE_FACULTY='$faculty' AND CODE_STATUS='01' AND UOC_SUBSTAFF_TYPE='$sub_staff' ORDER BY CODE_DEPARTMENT ASC";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = array(
				'PERSON_CODE'=>$rdep['PERSON_CODE'],
				'CODE_PERSON'=>$rdep['CODE_PERSON'],
				'NAME_PRENAME_THA'=>$rdep['NAME_PRENAME_THA'],
				'FIRST_NAME_THA'=>$rdep['FIRST_NAME_THA'],
				'LAST_NAME_THA'=>$rdep['LAST_NAME_THA'],
				'NAME_FACULTY'=>$rdep['NAME_FACULTY'],
				'CODE_DEPARTMENT'=>$rdep['CODE_DEPARTMENT'],
				'NAME_DEPARTMENT'=>$rdep['NAME_DEPARTMENT'],
				'EMAIL2'=>$rdep['EMAIL2'],
				'PHONE'=>$rdep['PHONE']
				);
				
			}
		
		return json_encode($data);
	}
	
	function getByPerson($conn,$person){
		$sql = "SELECT * FROM UOC_GENERAL_PROFILE WHERE CODE_PERSON='$person'";
		$sql_education = "SELECT * FROM SDU_ALL_EDUCATION WHERE CODE_PERSON='$person'";
			$stdt = oci_parse($conn,$sql);
			$stdt_education = oci_parse($conn,$sql_education);
			oci_execute($stdt);
			oci_execute($stdt_education);
			while($edu = oci_fetch_array($stdt_education)) {
				$education[] = array("NAME_EDU_LEV"=>$edu['NAME_EDU_LEV'],"QUA_MAJOR"=>$edu['QUA_MAJOR'],"QUA_SCHOOL"=>$edu['QUA_SCHOOL']);
			}
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = array(
				"PERSON_CODE"=>$rdep["PERSON_CODE"],
				"CODE_PERSON"=>$rdep["CODE_PERSON"],
				"NAME_PRENAME_THA"=>$rdep["NAME_PRENAME_THA"],
				"FIRST_NAME_THA"=>$rdep["FIRST_NAME_THA"],
				"LAST_NAME_THA"=>$rdep["LAST_NAME_THA"],
				"NAME_FACULTY"=>$rdep["NAME_FACULTY"],
				"CODE_DEPARTMENT"=>$rdep["CODE_DEPARTMENT"],
				"NAME_DEPARTMENT"=>$rdep["NAME_DEPARTMENT"],
				'EMAIL2'=>$rdep['EMAIL2'],
				'PHONE'=>$rdep['PHONE'],
				'CU_NAME_PROVINCE'=>$rdep['CU_NAME_PROVINCE'],
				"EDUCATION"=>$education
				);
			}
			
		return json_encode($data);
	}
	
	
	
	
	
	
?>