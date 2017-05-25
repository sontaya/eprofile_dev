<?php


$conn = oci_connect('SDPERSON','PERSON','10.202.1.13/RSDUE2M','AL32UTF8');
 
$sql = "SELECT * FROM UOC_GENERAL_PROFILE WHERE CODE_FACULTY='05'";
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
				'CODE_DEPARTMENT'=>$rdep['CODE_DEPARTMENT']
				);
				
			}
		
		echo json_encode($data);
   
   
 ?>