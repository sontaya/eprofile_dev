<? 
		session_start();
		include("config.inc.php");

	

			$s = trim($_POST["keyword"]);
			$keyword = " AND (FIRST_NAME_THA LIKE '%".$s."%' OR LAST_NAME_THA LIKE '%".$s."%' 
								OR LOWER(FIRST_NAME_ENG) LIKE '%".strtolower($s)."%' OR LOWER(LAST_NAME_ENG) LIKE '%".strtolower($s)."%' OR CODE_PERSON LIKE '%".$s."%' )";
			
			if($_POST["emp_faculty"] <> ""){
				$keyfac = " AND CODE_FACULTY = '".$_POST["emp_faculty"]."'";
			}else{
				$keyfac = "";	
			}

			if($_POST["emp_department"] <> ""){
				$keydep = " AND CODE_DEPARTMENT = '".$_POST["emp_department"]."'";
			}else{
				$keydep = "";	
			}

			if($_POST["emp_type"] <> ""){
				$keytype = " AND STAFF_TYPE = '".$_POST["emp_type"]."'";
			}else{ 
				$keytype = "";
			}
			
			if($_POST["staff_status"] <> ""){
				$keystatus = " AND CODE_STATUS = '".$_POST["staff_status"]."'";
			}else{ 
				$keystatus = "";
			}
			
			$sql_search = "SELECT CODE_PERSON,CITIZEN_CODE, 
								FIRST_NAME_THA||'  '||LAST_NAME_THA AS FULLNAME_THA,
								INITCAP(FIRST_NAME_ENG||'  '||LAST_NAME_ENG) AS FULLNAME_ENG,
								STAFF_TYPE, STAFF_TYPE_NAME, CODE_FACULTY, NAME_FACULTY,
								CODE_DEPARTMENT, NAME_DEPARTMENT, CODE_SITE, NAME_SITE, 
								TO_CHAR(BIRTH_DATE, 'DD/MM/YYYY', 'NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI') AS BIRTH_DATE_THA, 
								TO_CHAR(START_WORK_DATE, 'DD/MM/YYYY', 'NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI') AS START_WORK_DATE_THA,
								PHONE, MOBILE1, PHONE_OFFICE,
								CODE_STATUS, NAME_STATUS
							FROM SDU_GENERAL_PROFILE 
							WHERE 1=1 $keyword $keyfac $keydep $keytype $keystatus";

		
			
			$st = oci_parse($conn,$sql_search);
			oci_execute($st);
			while(($row = oci_fetch_assoc($st)) != false) {
				$rows[] = $row;
			}



		header("Content-Type: application/json");
		echo json_encode($rows);


		oci_free_statement($st);
		oci_close($conn);    
	 
?>