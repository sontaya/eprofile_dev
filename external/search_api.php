<?php

	header('content-type: application/json; charset=utf-8');
	header("access-control-allow-origin: *");
	
	$conn = oci_connect('SDPERSON','PERSON','10.202.1.13/RSDUE2M','AL32UTF8');
	
	if($_GET['all']){

	}else if($_GET['faculty']){
		echo faculty($conn,$_GET['faculty']);
		
	}else if($_GET['department']){
		echo department($conn,$_GET['department']);
		
	}else if($_GET['personal']){
		echo personal($conn,$_GET['personal']);
		
	}else{
	
	}

	
	function faculty($conn,$faculty){
		$sql = "SELECT * FROM FACULTY WHERE NAME_FACULTY LIKE '%$faculty%'  ORDER BY NAME_FACULTY ASC ";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = array(
				'name'=>$rdep['NAME_FACULTY'],
				'code'=>$rdep['CODE_FACULTY'],
				);
				
			}
			
			$result['items'] = $data;
		
		return json_encode($result);
		
	}
	
	
		function department($conn,$department){
		$sql = "SELECT * FROM DEPARTMENT_SECTION 
				LEFT JOIN FACULTY 
				ON   DEPARTMENT_SECTION.CODE_FACULTY = FACULTY.CODE_FACULTY
				WHERE NAME_DEPARTMENT_SECTION LIKE '%$department%'
				ORDER BY NAME_DEPARTMENT_SECTION ASC ";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = array(
				'name'=>$rdep['NAME_DEPARTMENT_SECTION'],
				'code'=>$rdep['CODE_DEPARTMENT_SECTION'],
				'faculty'=>$rdep['NAME_FACULTY'],
				);
				
			}
			
			$result['items'] = $data;
		
		return json_encode($result);
		
	}
	
	function personal($conn,$text){
		$sql = "SELECT * FROM SDU_BIODATA_TAB WHERE EMP_ID LIKE '%$text%' OR BIO_FNAME_TH LIKE '%$text%' OR BIO_LNAME_TH LIKE '%$text%' ORDER BY BIO_FNAME_TH";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = array(
				'name'=>$rdep['BIO_FNAME_TH'] . ' ' . $rdep['BIO_LNAME_TH'],
				'code'=>$rdep['EMP_ID'],
				'mobile'=>$rdep['BIO_MOBILE_1'],
				);
				
			}
			
			$result['items'] = $data;
		
		return json_encode($result);
		
	}



	
	
	
	
?>