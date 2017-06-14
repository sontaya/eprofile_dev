
<?
	$fpath = '../';
	require_once($fpath."includes/connect.php");
	include "update_by.php";

	$emp_id = $_SESSION['EMP_ID'];


	$query = oci_parse($conn, "SELECT * FROM  ".TB_CURRENT_WORK_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'");
	oci_execute($query);
	$row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS);

	$query_biodata = oci_parse($conn, "SELECT emp_id, person_id FROM  ".TB_BIODATA_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'");
	oci_execute($query_biodata);
	$row_biodata = oci_fetch_array($query_biodata, OCI_ASSOC+OCI_RETURN_NULLS);

	$sl_status = $_POST["sl_status"];
	$sl_reason = $_POST["sl_reason"];
	$sl_effective = $_POST["sl_effective"];



	//if($_POST["sl_effective_date"] != "" ) $effective_date = date2_formatdb($_POST["sl_effective_date"]);
		
	$MUA_EMP_TYPE = $row["CWK_MUA_EMP_TYPE"];
	$MUA_EMP_SUBTYPE = $row["CWK_MUA_EMP_SUBTYPE"];
	$MUA_MAIN = $row["CWK_MUA_MAIN"];
	$MUA_SUBMAIN = $row["CWK_MUA_SUBMAIN"];
	$DSU_EDU_CENTER = $row["CWK_DSU_EDU_CENTER"];
	$DSU_POS = $row["CWK_DSU_POS"];
	$MUA_VPOS = $row["CWK_MUA_VPOS"];
	$MUA_LEVEL = $row["CWK_MUA_LEVEL"];
	$MUA_MPOS = $row["CWK_MUA_MPOS"];
	$MUA_WORK_GROUP = $row["CWK_MUA_WORK_GROUP"];
	$START_WORK_DATE = $row["CWK_START_WORK_DATE"];

	$PERSON_ID = $row_biodata["PERSON_ID"];



	  if(isset($_FILES["ccs"]["type"])){

		  $validextensions = array("jpeg", "jpg", "png", "pdf");
		  $temporary = explode(".", $_FILES["ccs"]["name"]);
		  $file_ccs_extension = end($temporary);

		  $new_ccs_name = "ccs-".strtotime("now").".".$file_ccs_extension;
		 
		  if ( 0 < $_FILES['ccs']['error'] ) {
			$new_ccs_name = "";
		  }else{
			$ccs_sourcePath = $_FILES['ccs']['tmp_name']; 
			$ccs_targetPath = "./files/ccs/".$new_ccs_name; 
			move_uploaded_file($ccs_sourcePath,$ccs_targetPath) ; 
		  }
	  }else{
		  $new_ccs_name = "";
	  }


			$result = $db->add_db(SDU_STATUS_LOG,array(
				"EMP_ID"=>"$emp_id",             
				"PERSON_ID"=>"$PERSON_ID",          
				"SL_MUA_EMP_TYPE"=>"$MUA_EMP_TYPE",
				"SL_MUA_EMP_SUBTYPE"=>"$MUA_EMP_SUBTYPE",
				"SL_MUA_MAIN"=>"$MUA_MAIN",
				"SL_MUA_SUBMAIN"=>"$MUA_SUBMAIN",
				"SL_DSU_EDU_CENTER"=>"$DSU_EDU_CENTER",
				"SL_DSU_POS"=>"$DSU_POS",
				"SL_MUA_VPOS"=>"$MUA_VPOS",
				"SL_MUA_LEVEL"=>"$MUA_LEVEL",
				"SL_MUA_MPOS"=>"$MUA_MPOS",
				"SL_MUA_WORK_GROUP"=>"$MUA_WORK_GROUP",
				"SL_START_WORK_DATE"=>"TO_DATE('$START_WORK_DATE','YYYY-MM-DD')", 
				"SL_STATUS"=>"$sl_status",          
				"SL_EFFECTIVE_DATE"=>"TO_DATE('$sl_effective','YYYY-MM-DD')",
				"SL_REASON"=>"$sl_reason",          
				"SL_APPROVE_DATE"=>"",    
				"SL_DOCUMENT"=>"$new_ccs_name",        
				"UPDATE_BY"=>"$update_user",          
				"LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')"

			),$conn);

		$db->closedb($conn);	

?>
     <input type="hidden" id="hid_submit_result" value="<?= $result ?>">
