<?php

	header('content-type: application/json; charset=utf-8');
	header("access-control-allow-origin: *");

	$conn = oci_connect('SDPERSON','PERSON','10.202.1.112/RSDUE2M','AL32UTF8');
	if($_GET['all']){
		getAll($conn);
	}else if($_GET['department']){
		echo getByDepartment($conn,$_GET['department'],$_GET['faculty']);
	}else if($_GET['faculty']){
		echo getByFaculty($conn,$_GET['faculty']);	
	}else if($_GET['person']){
		echo getByPerson($conn,$_GET['person']);
	}else{
		index();
	}

	
	function index(){
		
	}
	
	function getAll($conn){
		$sql = "SELECT * FROM UOC_GENERAL_PROFILE WHERE CODE_STATUS='01'";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = $rdep;
			}
			
		echo json_encode($data);
	}

	function getByFaculty($conn,$faculty){
		$sql = "SELECT * FROM UOC_GENERAL_PROFILE WHERE CODE_FACULTY='$faculty' AND CODE_STATUS='01'";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = $rdep;
			}
		
		return json_encode($data);
	}
	
	function getByDepartment($conn,$department,$faculty){
		$sql = "SELECT * FROM UOC_GENERAL_PROFILE WHERE CODE_DEPARTMENT='$department' AND CODE_FACULTY='$faculty' AND CODE_STATUS='01'";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = $rdep;
			}
		
		return json_encode($data);
	}
	
	
	function getByPerson($conn,$person){
		$sql = "SELECT * FROM UOC_GENERAL_PROFILE WHERE PERSON_CODE='$person'";
		
		$stdt = oci_parse($conn,$sql);
	
		oci_execute($stdt);
			
		while($rdep = oci_fetch_array($stdt)) {
			$data[] = $rdep;
		}
			
		return json_encode($data);
	}
	
	
	
	
	
	
?>