<?php

	header('content-type: application/json; charset=utf-8');
	header("access-control-allow-origin: *");

	$conn = oci_connect('SDPERSON','PERSON','10.202.1.112/RSDUE2M','AL32UTF8');
	if($_GET['all']){
		getAll($conn);
	}else if($_GET['faculty']){
		echo getByFaculty($conn,$_GET['faculty']);
	}else{
		index();
	}

	
	function index(){
		
	}
	
	function getAll($conn){
		$sql = "SELECT CODE_FACULTY,NAME_FACULTY FROM UOC_GENERAL_PROFILE WHERE NAME_FACULTY <> ' ' AND CODE_STATUS='01' GROUP BY CODE_FACULTY,NAME_FACULTY";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = $rdep;
			}
			
		echo json_encode($data);
	}

	function getByFaculty($conn,$faculty){
		$sql = "SELECT CODE_DEPARTMENT,NAME_DEPARTMENT FROM UOC_GENERAL_PROFILE WHERE CODE_DEPARTMENT <> ' ' AND NAME_DEPARTMENT <> ' ' AND CODE_FACULTY='$faculty' AND CODE_STATUS='01' GROUP BY CODE_DEPARTMENT,NAME_DEPARTMENT";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while($rdep = oci_fetch_array($stdt)) {
				$data[] = $rdep;
			}
			
		echo json_encode($data);
	}
	
	
?>