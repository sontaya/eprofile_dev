<?php
@session_start();
	$fpath = '../';
	require_once($fpath."includes/connect.php");
	include "update_by.php";
	$emp_id = $_POST['emp_id'];
	$b_contract_no = $_POST['b_contract_no'];
    $contract_no = $_POST['contract_no'];
	$contract_period = $_POST['contract_period'];
	$contract_year = $_POST['contract_year'];
	$contract_position = $_POST['contract_position'];

     $ck_mua_emp_type = $_POST["ck_mua_emp_type"];
    $contract_no2 = $_POST["contract_no2"];
    $scorse_yer = $_POST["scorse_yer"];
    $directive = $_POST["directive"];
    $directive_no = $_POST["directive_no"];
    if($_POST['directive_date'] != "") $directive_date = date2_formatdb($_POST['directive_date']);
    
    $sch_order_no = $_POST["sch_order_no"];
    $sch_at = $_POST["sch_at"];
    if($_POST['sch_at_date'] != "") $sch_at_date = date2_formatdb($_POST['sch_at_date']);

    $employ = $_POST["employ"];
    $employ_no = $_POST["employ_no"];
    $secret_document = $_POST["secret_document"];
    if($_POST['document_date'] != "") $document_date = date2_formatdb($_POST['document_date']);
    $secret_b = $_POST["secret_b"];
    $secret_name = $_POST["secret_name"];


	$contract_start = "";
	$contract_finish = "";
	if($_POST['contract_start'] != "") $contract_start = date2_formatdb($_POST['contract_start']);
	if($_POST['contract_finish'] != "") $contract_finish = date2_formatdb($_POST['contract_finish']);
	$contract_m60 = $_POST['contract_m60'];
	$contract_comment = $_POST['contract_comment'];


     $folderName = "files/con_file/";
    if($_FILES["one_files"]["name"] <> ""){
        $array_last1=explode(".",$_FILES["one_files"]["name"]);
        $last1=strtolower($array_last1[count($array_last1)-1]);
        $name_fi1= rand(10000, 990000) . '_' . time() . '_cd.' .$last1; 
        $filePath1 =$folderName .$name_fi1;
        if(move_uploaded_file($_FILES["one_files"]["tmp_name"],$filePath1))
        {
            $file_one = $name_fi1;
        }
    }else{
        $file_one = $_POST['one_files_h'];
    }
    
    if($_FILES["two_files"]["name"] <> ""){
        $array_last2=explode(".",$_FILES["two_files"]["name"]);
        $last2=strtolower($array_last2[count($array_last2)-1]);
        $name_fi2= rand(10000, 990000) . '_' . time() . '_cd.' .$last2; 
        $filePath2 =$folderName .$name_fi2;
        if(move_uploaded_file($_FILES["two_files"]["tmp_name"],$filePath2))
        {
            $file_two = $name_fi2;
        }
    }else{
        $file_two = $_POST['two_files_h'];
    }
    

    if($_FILES["tree_files"]["name"] <> ""){
        $array_last3=explode(".",$_FILES["tree_files"]["name"]);
        $last3=strtolower($array_last3[count($array_last3)-1]);
        $name_fi3= rand(10000, 990000) . '_' . time() . '_cd.' .$last3; 
        $filePath3 =$folderName .$name_fi3;
        if(move_uploaded_file($_FILES["tree_files"]["tmp_name"],$filePath3))
        {
            $file_tree = $name_fi3;
        }
    }else{
        $file_tree = $_POST['tree_files_h'];
    }
    

	$ss=$db->update_db(TB_CONTRACT_TAB,array(
						"CONTRACT_EXPIRED"=>"1"
						),"EMP_ID='$emp_id' AND CONTRACT_NO = '$b_contract_no'",$conn); 
    if($ss){
        echo "0k";
    }

		$numrow = $db->count_row(TB_CONTRACT_TAB," WHERE EMP_ID = '$emp_id' AND CONTRACT_NO = '$contract_no' ",$conn); 
		if($numrow == 0) {
			$result = $db->add_db(TB_CONTRACT_TAB,array(
			"EMP_ID"=>"$emp_id",
			"CONTRACT_NO"=>"$contract_no",
			"CONTRACT_PERIOD"=>"$contract_period",
			"CONTRACT_YEAR"=>"$contract_year",
			"CONTRACT_POSITION"=>"$contract_position",
			"CONTRACT_START"=>"$contract_start",
			"CONTRACT_FINISH"=>"$contract_finish",
			"CONTRACT_M60"=>"$contract_m60",
			"CONTRACT_COMMENT"=>"$contract_comment",
			"CONTRACT_EXPIRED"=>"0",
            "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
            "UPDATE_BY"=>"$update_user",
            "CK_MUA_EMP_TYPE"=>"$ck_mua_emp_type",
            "CONTRACT_NO2"=>"$contract_no2",
            "SCORSE_YER"=>"$scorse_yer",
            "DIRECTIVE"=>"$directive",
            "DIRECTIVE_NO"=>"$directive_no",
            "DIRECTIVE_DATE"=>"$directive_date",
            "SCH_ORDER_NO"=>"$sch_order_no",
            "SCH_AT"=>"$sch_at",
            "SCH_AT_DATE"=>"$sch_at_date",
            "EMPLOY"=>"$employ",
            "EMPLOY_NO"=>"$employ_no",
            "SECRET_DOCUMENT"=>"$secret_document",
            "DOCUMENT_DATE"=>"$document_date",
            "SECRET_B"=>"$secret_b",
            "SECRET_NAME"=>"$secret_name",
                
            "ONE_FILES"=>"$file_one",
            "TWO_FILES"=>"$file_two",
            "TREE_FILES"=>"$file_tree"
			),$conn);
		}
		else { // UPDATE CONTRACT
			$result=$db->update_db(TB_CONTRACT_TAB,array(
			"CONTRACT_PERIOD"=>"$contract_period",
			"CONTRACT_YEAR"=>"$contract_year",
			"CONTRACT_POSITION"=>"$contract_position",
			"CONTRACT_START"=>"$contract_star",
			"CONTRACT_FINISH"=>"$contract_finish",
			"CONTRACT_M60"=>"$contract_m60",
			"CONTRACT_COMMENT"=>"$contract_comment",
			"CONTRACT_EXPIRED"=>"0",
            "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
            "UPDATE_BY"=>"$update_user",
            "CK_MUA_EMP_TYPE"=>"$ck_mua_emp_type",
            "CONTRACT_NO2"=>"$contract_no2",
            "SCORSE_YER"=>"$scorse_yer",
            "DIRECTIVE"=>"$directive",
            "DIRECTIVE_NO"=>"$directive_no",
            "DIRECTIVE_DATE"=>"$directive_date",
            "SCH_ORDER_NO"=>"$sch_order_no",
            "SCH_AT"=>"$sch_at",
            "SCH_AT_DATE"=>"$sch_at_date",
            "EMPLOY"=>"$employ",
            "EMPLOY_NO"=>"$employ_no",
            "SECRET_DOCUMENT"=>"$secret_document",
            "DOCUMENT_DATE"=>"$document_date",
            "SECRET_B"=>"$secret_b",
            "SECRET_NAME"=>"$secret_name",
                
            "ONE_FILES"=>"$file_one",
            "TWO_FILES"=>"$file_two",
            "TREE_FILES"=>"$file_tree"
			),"EMP_ID='$emp_id' AND CONTRACT_NO = '$contract_no'",$conn); 
		}
	
	$db->closedb($conn);
?>
<script language="javascript">
var ran=Math.random();
alert("ต่อสัญญาใหม่เรียบร้อยแล้ว");
self.opener.load_page2("ex_contract2.php?"+ran);
window.close();
</script>