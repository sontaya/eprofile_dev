
<?
	$fpath = '../';
	require_once($fpath."includes/connect.php");
	include "update_by.php";

	$emp_id = $_SESSION['EMP_ID'];


	$query = oci_parse($conn, "SELECT * FROM  ".TB_CURRENT_WORK_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'");
	oci_execute($query);
	$row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS);

	$sl_status = $_POST["sl_status"];
	$sl_reason = $_POST["sl_reason"];
	if($_POST["sl_effective_date"] != "" ) $effective_date = date2_formatdb($_POST["sl_effective_date"]);
		
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



			$result = $db->add_db(SDU_STATUS_LOG,array(
				"EMP_ID"=>"$emp_id",             
				"PERSON_ID"=>"",          
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
				"SL_START_WORK_DATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')", 
				"SL_STATUS"=>"$sl_status",          
				"SL_EFFECTIVE_DATE"=>"TO_DATE('$effective_date','YYYY-MM-DD')",
				"SL_REASON"=>"$sl_reason",          
				"SL_APPROVE_DATE"=>"",    
				"SL_DOCUMENT"=>"",        
				"UPDATE_BY"=>"$update_user",          
				"LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')"

			),$conn);


		$db->closedb($conn);	

?>
     
