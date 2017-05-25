<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";

    
$st_id_f = $_POST["st_id"];
$type_st = $_POST["type_st"];
$st_order_no = $_POST["st_order_no"];
$st_at = $_POST["st_at"];
if($_POST["st_at_date"] != "" ) $st_at_date = date2_formatdb($_POST["st_at_date"]);
    
$st_mua_emp_type = $_POST["st_mua_emp_type"];
$st_mua_main = $_POST["st_mua_main"];
$st_mua_submain = $_POST["st_mua_submain"];
$st_dsu_edu_center = $_POST["st_dsu_edu_center"];
$st_current_history = $_POST["st_current_history"];
$st_money_type = $_POST["cwk_budget1"];
$st_munny_history = $_POST["st_munny_history"];
    
$st_mua_emp_type2 = $_POST["st_mua_emp_type2"];
$st_mua_main2 = $_POST["st_mua_main2"];
$st_mua_submain2 = $_POST["st_mua_submain2"];
$st_dsu_edu_center2 = $_POST["st_dsu_edu_center2"];
$st_current_history2 = $_POST["st_current_history2"];
$st_money_type2 = $_POST["cwk_budget2"];
$st_munny_history2 = $_POST["st_munny_history2"];
    
if($_POST["start_dates"] != "" ) $start_dates = date2_formatdb($_POST["start_dates"]);
if($_POST["end_dates"] != "" ) $end_dates = date2_formatdb($_POST["end_dates"]);
$start_ck = $_POST["start_ck"];
$st_note = $_POST["st_note"];
$start_st = $_POST["start_st"];

$pags_id = $_POST["pags_id"];


if($st_id_f == "" ){
        $st_id = auto_increment("ST_ID",TB_SDU_SECTOR_TRANSFER_TAB);
		$result_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "ST_ID"=>"$st_id",
                                                "ST_ORDER_NO"=>"$st_order_no",
                                                "ST_AT"=>"$st_at",
                                                "ST_AT_DATE"=>"$st_at_date",
                                                "ST_MUA_EMP_TYPE"=>"$st_mua_emp_type",
                                                "ST_MUA_MAIN"=>"$st_mua_main",
                                                "ST_MUA_SUBMAIN"=>"$st_mua_submain",
                                                "ST_DSU_EDU_CENTER"=>"$st_dsu_edu_center",
                                                "ST_CURRENT_HISTORY"=>"$st_current_history",
                                                "ST_MONEY_TYPE"=>"$st_money_type",
                                                "ST_MUNNY_HISTORY"=>"$st_munny_history",
            
                                                "ST_MUA_EMP_TYPE2"=>"$st_mua_emp_type2",
                                                "ST_MUA_MAIN2"=>"$st_mua_main2",
                                                "ST_MUA_SUBMAIN2"=>"$st_mua_submain2",
                                                "ST_DSU_EDU_CENTER2"=>"$st_dsu_edu_center2",
                                                "ST_CURRENT_HISTORY2"=>"$st_current_history2",
                                                "ST_MONEY_TYPE2"=>"$st_money_type2",
                                                "ST_MUNNY_HISTORY2"=>"$st_munny_history2",

                                                "START_DATES"=>"$start_dates",
                                                "END_DATES"=>"$end_dates",
                                                "START_CK"=>"$start_ck",
                                                "ST_NOTE"=>"$st_note",
                                                "START_ST"=>"$start_st",
                                                "TYPE_ST"=>"$type_st"
            
											  ),$conn);
        if($result_add){
            if (count($_FILES["st_files"]) > 0) {
              $folderName = "files/st_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["st_files"]["name"]); $i++) {
                if ($_FILES["st_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["st_files"]["name"][$i])));
                  //$name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["st_files"]["name"][$i];
                  $array_last=explode(".",$_FILES["st_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_ST.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["st_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$st_id",
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
	}else{
		$result_edit=$db->update_db(TB_SDU_SECTOR_TRANSFER_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "ST_ORDER_NO"=>"$st_order_no",
                                                "ST_AT"=>"$st_at",
                                                "ST_AT_DATE"=>"$st_at_date",
                                                "ST_MUA_EMP_TYPE"=>"$st_mua_emp_type",
                                                "ST_MUA_MAIN"=>"$st_mua_main",
                                                "ST_MUA_SUBMAIN"=>"$st_mua_submain",
                                                "ST_DSU_EDU_CENTER"=>"$st_dsu_edu_center",
                                                "ST_CURRENT_HISTORY"=>"$st_current_history",
                                                "ST_MONEY_TYPE"=>"$st_money_type",
                                                "ST_MUNNY_HISTORY"=>"$st_munny_history",
            
                                                "ST_MUA_EMP_TYPE2"=>"$st_mua_emp_type2",
                                                "ST_MUA_MAIN2"=>"$st_mua_main2",
                                                "ST_MUA_SUBMAIN2"=>"$st_mua_submain2",
                                                "ST_DSU_EDU_CENTER2"=>"$st_dsu_edu_center2",
                                                "ST_CURRENT_HISTORY2"=>"$st_current_history2",
                                                "ST_MONEY_TYPE2"=>"$st_money_type2",
                                                "ST_MUNNY_HISTORY2"=>"$st_munny_history2",
            
                                                "START_DATES"=>"$start_dates",
                                                "END_DATES"=>"$end_dates",
                                                "START_CK"=>"$start_ck",
                                                "ST_NOTE"=>"$st_note",
                                                "START_ST"=>"$start_st",
                                                "TYPE_ST"=>"$type_st"
					                          ),"ST_ID = '$st_id_f'",$conn);
        if($result_edit){
            if (count($_FILES["st_files"]) > 0) {
              $folderName = "files/st_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["st_files"]["name"]); $i++) {
                if ($_FILES["st_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["st_files"]["name"][$i])));
                 // $name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["st_files"]["name"][$i];  
                  $array_last=explode(".",$_FILES["st_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_ST.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["st_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$st_id_f",
                                                "ID_PAGS"=>"$pags_id"
											  ),$conn);
                     $counter++;
                   }
                }
              }
            }
            if($type_st == "1" || $type_st == "4"){
            ?>
            <script language="javascript">
            window.top.change_data('current_work.php?','../images/head2/work_data/current_work.png');
            </script>
            <?
            }else{
            ?>
            <script language="javascript">
            window.top.change_data('sector_transfer.php?','../images/head2/work_data/sector_trnfer.png');
            </script>
            <? 
            }
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
