<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";

    
$cj_id_f = $_POST["cj_id"];
$cj_definition = $_POST["definition"];
$cj_order_no = $_POST["cj_order_no"];
$cj_at = $_POST["cj_at"];
if($_POST["cj_at_date"] != "" ) $cj_at_date = date2_formatdb($_POST["cj_at_date"]);

$cj_instructor = $_POST["cj_instructor"];
$cj_mua_main_test = $_POST["cj_mua_main_test"];
$cj_mua_submain_test = $_POST["cj_mua_submain_test"];
$cj_dsu_edu_center_test = $_POST["cj_dsu_edu_center_test"];
if($_POST["start_dates_test"] != "" ) $start_dates_test = date2_formatdb($_POST["start_dates_test"]);
if($_POST["end_dates_test"] != "" ) $end_dates_test = date2_formatdb($_POST["end_dates_test"]);
$term_test = $_POST["term_test"];
$test_type = $_POST["test_type"];
$test_noet = $_POST["test_noet"];
    
$cj_order_no_two = $_POST["cj_order_no_two"];
$cj_at_two = $_POST["cj_at_two"];
if($_POST["cj_at_date_two"] != "" ) $cj_at_date_two = date2_formatdb($_POST["cj_at_date_two"]);
    
$cj_mua_emp_type = $_POST["cj_mua_emp_type"];
$cj_mua_main = $_POST["cj_mua_main"];
$cj_mua_submain = $_POST["cj_mua_submain"];
$cj_dsu_edu_center = $_POST["cj_dsu_edu_center"];
$cj_current_history = $_POST["cj_current_history"];
$cj_munny_history = $_POST["cj_munny_history"];
    
$cj_mua_emp_type2 = $_POST["cj_mua_emp_type2"];
$cj_mua_main2 = $_POST["cj_mua_main2"];
$cj_mua_submain2 = $_POST["cj_mua_submaintwo"];
$cj_dsu_edu_center2 = $_POST["cj_dsu_edu_center2"];
$cj_current_history2 = $_POST["cj_current_history2"];
$cj_munny_history2 = $_POST["cj_munny_history2"];
    
if($_POST["start_dates"] != "" ) $start_dates = date2_formatdb($_POST["start_dates"]);
if($_POST["end_dates"] != "" ) $end_dates = date2_formatdb($_POST["end_dates"]);
$start_ck = $_POST["start_ck"];
$cj_note = $_POST["cj_note"];
if($_POST["start_st"] != "" ) $start_cj = date2_formatdb($_POST["start_st"]);

$pags_id = $_POST["pags_id"];


if($cj_id_f == "" ){
        $cj_id = auto_increment("CJ_ID",TB_SDU_CHANGE_JOB_TAB);
		$result_add=$db->add_db(TB_SDU_CHANGE_JOB_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "CJ_ID"=>"$cj_id",
                                                "CJ_DEFINITION"=>"$cj_definition",
                                                "CJ_ORDER_NO"=>"$cj_order_no",
                                                "CJ_AT"=>"$cj_at",
                                                "CJ_AT_DATE"=>"$cj_at_date",
                                                
                                                "CJ_INSTRUCTOR"=>"$cj_instructor",
                                                "CJ_MUA_MAIN_TEST"=>"$cj_mua_main_test",
                                                "CJ_MUA_SUBMAIN_TEST"=>"$cj_mua_submain_test",
                                                "CJ_DSU_EDU_CENTER_TEST"=>"$cj_dsu_edu_center_test",
                                                "START_DATES_TEST"=>"$start_dates_test",
                                                "END_DATES_TEST"=>"$end_dates_test",
                                                "TERM_TEST"=>"$term_test",
                                                "TEST_TYPE"=>"$test_type",
                                                "TEST_NOET"=>"$test_noet",
                                                
                                                "CJ_ORDER_NO_TWO"=>"$cj_order_no_two",
                                                "CJ_AT_TWO"=>"$cj_at_two",
                                                "CJ_AT_DATE_TWO"=>"$cj_at_date_two",
            
                                                "CJ_MUA_EMP_TYPE"=>"$cj_mua_emp_type",
                                                "CJ_MUA_MAIN"=>"$cj_mua_main",
                                                "CJ_MUA_SUBMAIN"=>"$cj_mua_submain",
                                                "CJ_DSU_EDU_CENTER"=>"$cj_dsu_edu_center",
                                                "CJ_CURRENT_HISTORY"=>"$cj_current_history",
                                                "ST_MONEY_TYPE"=>"$st_money_type",
                                                "CJ_MUNNY_HISTORY"=>"$cj_munny_history",
            
                                                "CJ_MUA_EMP_TYPE2"=>"$cj_mua_emp_type2",
                                                "CJ_MUA_MAIN2"=>"$cj_mua_main2",
                                                "CJ_MUA_SUBMAIN2"=>"$cj_mua_submain2",
                                                "CJ_DSU_EDU_CENTER2"=>"$cj_dsu_edu_center2",
                                                "CJ_CURRENT_HISTORY2"=>"$cj_current_history2",
                                                "ST_MONEY_TYPE2"=>"$st_money_type2",
                                                "CJ_MUNNY_HISTORY2"=>"$cj_munny_history2",

                                                "START_DATES"=>"$start_dates",
                                                "END_DATES"=>"$end_dates",
                                                "START_CK"=>"$start_ck",
                                                "CJ_NOTE"=>"$cj_note",
                                                "START_CJ"=>"$start_cj"
            
											  ),$conn);
        if($result_add){
            if (count($_FILES["cj_files"]) > 0) {
              $folderName = "files/cj_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["cj_files"]["name"]); $i++) {
                if ($_FILES["cj_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["cj_files"]["name"][$i])));
                  //$name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["cj_files"]["name"][$i]; 
                  $array_last=explode(".",$_FILES["cj_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_CJ.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["cj_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$cj_id",
                                                "ID_PAGS"=>"$pags_id"
											  ),$conn);
                     $counter++;
                   }
                }
              }
            }
            ?>
            <script language="javascript">
            window.top.change_data('change_job.php?','../images/head2/work_data/change_job.png');
            </script>
            <?
            
        }
	}else{
		$result_edit=$db->update_db(TB_SDU_CHANGE_JOB_TAB,array(
                                                "CJ_DEFINITION"=>"$cj_definition",
                                                "CJ_ORDER_NO"=>"$cj_order_no",
                                                "CJ_AT"=>"$cj_at",
                                                "CJ_AT_DATE"=>"$cj_at_date",
                                                
                                                "CJ_INSTRUCTOR"=>"$cj_instructor",
                                                "CJ_MUA_MAIN_TEST"=>"$cj_mua_main_test",
                                                "CJ_MUA_SUBMAIN_TEST"=>"$cj_mua_submain_test",
                                                "CJ_DSU_EDU_CENTER_TEST"=>"$cj_dsu_edu_center_test",
                                                "START_DATES_TEST"=>"$start_dates_test",
                                                "END_DATES_TEST"=>"$end_dates_test",
                                                "TERM_TEST"=>"$term_test",
                                                "TEST_TYPE"=>"$test_type",
                                                "TEST_NOET"=>"$test_noet",
                                                
                                                "CJ_ORDER_NO_TWO"=>"$cj_order_no_two",
                                                "CJ_AT_TWO"=>"$cj_at_two",
                                                "CJ_AT_DATE_TWO"=>"$cj_at_date_two",
            
                                                "CJ_MUA_EMP_TYPE"=>"$cj_mua_emp_type",
                                                "CJ_MUA_MAIN"=>"$cj_mua_main",
                                                "CJ_MUA_SUBMAIN"=>"$cj_mua_submain",
                                                "CJ_DSU_EDU_CENTER"=>"$cj_dsu_edu_center",
                                                "CJ_CURRENT_HISTORY"=>"$cj_current_history",
                                                "ST_MONEY_TYPE"=>"$st_money_type",
                                                "CJ_MUNNY_HISTORY"=>"$cj_munny_history",
            
                                                "CJ_MUA_EMP_TYPE2"=>"$cj_mua_emp_type2",
                                                "CJ_MUA_MAIN2"=>"$cj_mua_main2",
                                                "CJ_MUA_SUBMAIN2"=>"$cj_mua_submain2",
                                                "CJ_DSU_EDU_CENTER2"=>"$cj_dsu_edu_center2",
                                                "CJ_CURRENT_HISTORY2"=>"$cj_current_history2",
                                                "ST_MONEY_TYPE2"=>"$st_money_type2",
                                                "CJ_MUNNY_HISTORY2"=>"$cj_munny_history2",

                                                "START_DATES"=>"$start_dates",
                                                "END_DATES"=>"$end_dates",
                                                "START_CK"=>"$start_ck",
                                                "CJ_NOTE"=>"$cj_note",
                                                "START_CJ"=>"$start_cj",
					                          ),"CJ_ID = '$cj_id_f'",$conn);
        if($result_edit){
            if (count($_FILES["cj_files"]) > 0) {
              $folderName = "files/cj_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["cj_files"]["name"]); $i++) {
                if ($_FILES["cj_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["cj_files"]["name"][$i])));
                  //$name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["cj_files"]["name"][$i]; 
                  $array_last=explode(".",$_FILES["cj_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_CJ.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["cj_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$cj_id_f",
                                                "ID_PAGS"=>"$pags_id"
											  ),$conn);
                     $counter++;
                   }
                }
              }
            }
            ?>
            <script language="javascript">
            window.top.change_data('current_work.php?','../images/head2/work_data/current_work.png');
            </script>
            <?
            }
        }
	

		
$db->closedb($conn);
?>
<script language="javascript">
//var ran=Math.random();
window.top.$("span#waiting").html("");
//indow.top.load_page("current_address.php?"+ran);
</script>
<?
}
?>
