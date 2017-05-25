<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";

    
$dm_id_f = $_POST["dm_id"];
$type_st = $_POST["type_st"];
$dm_order_no = $_POST["dm_order_no"];
$dm_at = $_POST["dm_at"];
    
if($_POST["dm_at_date"] != "" ) $dm_at_date = date2_formatdb($_POST["dm_at_date"]);
    
$dm_mua_emp_type = $_POST["dm_mua_emp_type"];
$dm_mua_main = $_POST["dm_mua_main"];
$dm_mua_submain = $_POST["dm_mua_submain"];
$dm_dsu_edu_center = $_POST["dm_dsu_edu_center"];
$dm_current_history = $_POST["dm_current_history"];
    
$munny_dm_1 = $_POST["munny_dm_1"];
$munny_dm_2 = $_POST["munny_dm_2"];
$munny_dm_3 = $_POST["munny_dm_3"];
$munny_dm_4 = $_POST["munny_dm_4"];
$munny_dm_5 = $_POST["munny_dm_5"];
    
$munny_one = $_POST["munny_one"];
$munny_two = $_POST["munny_two"];
$munny_tree = $_POST["munny_tree"];
$munny_four = $_POST["munny_four"];
$munny_five = $_POST["munny_five"];

if($_POST["start_dates"] != "" ) $start_dates = date2_formatdb($_POST["start_dates"]);
if($_POST["end_dates"] != "" ) $end_dates = date2_formatdb($_POST["end_dates"]);
$start_ck = $_POST["start_ck"];
$dm_note = $_POST["dm_note"];
if($_POST["start_dm"] != "" ) $start_dm = date2_formatdb($_POST["start_dm"]);
    
$redo_dm_1 = $_POST["redo_dm_1"];
$redo_dm_2 = $_POST["redo_dm_2"];
$redo_dm_3 = $_POST["redo_dm_3"];
$redo_dm_4 = $_POST["redo_dm_4"];
$redo_dm_5 = $_POST["redo_dm_5"];

$pags_id = $_POST["pags_id"];
    
    
if($dm_id_f == "" ){
        $dm_id = auto_increment("DM_ID",TB_SDU_DEFINE_MANAGE_TAB);
		$result_add=$db->add_db(TB_SDU_DEFINE_MANAGE_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "DM_ID"=>"$dm_id",
            
                                                "DM_ORDER_NO"=>"$dm_order_no",
                                                "DM_AT"=>"$dm_at",
                                                "DM_AT_DATE"=>"$dm_at_date",
            
                                                "DM_MUA_EMP_TYPE"=>"$dm_mua_emp_type",
                                                "DM_MUA_MAIN"=>"$dm_mua_main",
                                                "DM_MUA_SUBMAIN"=>"$dm_mua_submain",
                                                "DM_DSU_EDU_CENTER"=>"$dm_dsu_edu_center",
                                                "DM_CURRENT_HISTORY"=>"$dm_current_history",
                                                
                                                "MUNNY_DM_1"=>"$munny_dm_1",
                                                "MUNNY_DM_2"=>"$munny_dm_2",
                                                "MUNNY_DM_3"=>"$munny_dm_3",
                                                "MUNNY_DM_4"=>"$munny_dm_4",
                                                "MUNNY_DM_5"=>"$munny_dm_5",
            
                                                "MUNNY_ONE"=>"$munny_one",
                                                "MUNNY_TWO"=>"$munny_two",
                                                "MUNNY_TREE"=>"$munny_tree",
                                                "MUNNY_FOUR"=>"$munny_four",
                                                "MUNNY_FIVE"=>"$munny_five",
            
                                                "START_DATES"=>"$start_dates",
                                                "END_DATES"=>"$end_dates",
                                                "START_CK"=>"$start_ck",
                                                "DM_NOTE"=>"$dm_note",
                                                "START_DM"=>"$start_dm",
                                                "REDO_DM_1"=>"$redo_dm_1",
                                                "REDO_DM_2"=>"$redo_dm_2",
                                                "REDO_DM_3"=>"$redo_dm_3",
                                                "REDO_DM_4"=>"$redo_dm_4",
                                                "REDO_DM_5"=>"$redo_dm_5"
            
											  ),$conn);
        if($result_add){
            if (count($_FILES["dm_files"]) > 0) {
              $folderName = "files/dm_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["dm_files"]["name"]); $i++) {
                if ($_FILES["dm_files"]["name"][$i] <> "") {

                  //$ext = explode(".", $_FILES["dm_files"]["name"][$i]);
                  $array_last=explode(".",$_FILES["dm_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_DM.' .$last;  
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["dm_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$dm_id",
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
		$result_edit=$db->update_db(TB_SDU_DEFINE_MANAGE_TAB,array(
                                                "EMP_ID"=>"$emp_id",
            
                                                "DM_ORDER_NO"=>"$dm_order_no",
                                                "DM_AT"=>"$dm_at",
                                                "DM_AT_DATE"=>"$dm_at_date",
            
                                                "DM_MUA_EMP_TYPE"=>"$dm_mua_emp_type",
                                                "DM_MUA_MAIN"=>"$dm_mua_main",
                                                "DM_MUA_SUBMAIN"=>"$dm_mua_submain",
                                                "DM_DSU_EDU_CENTER"=>"$dm_dsu_edu_center",
                                                "DM_CURRENT_HISTORY"=>"$dm_current_history",
            
                                                "MUNNY_DM_1"=>"$munny_dm_1",
                                                "MUNNY_DM_2"=>"$munny_dm_2",
                                                "MUNNY_DM_3"=>"$munny_dm_3",
                                                "MUNNY_DM_4"=>"$munny_dm_4",
                                                "MUNNY_DM_5"=>"$munny_dm_5",
            
                                                "MUNNY_ONE"=>"$munny_one",
                                                "MUNNY_TWO"=>"$munny_two",
                                                "MUNNY_TREE"=>"$munny_tree",
                                                "MUNNY_FOUR"=>"$munny_four",
                                                "MUNNY_FIVE"=>"$munny_five",
            
                                                "START_DATES"=>"$start_dates",
                                                "END_DATES"=>"$end_dates",
                                                "START_CK"=>"$start_ck",
                                                "DM_NOTE"=>"$dm_note",
                                                "START_DM"=>"$start_dm",
                                                "REDO_DM_1"=>"$redo_dm_1",
                                                "REDO_DM_2"=>"$redo_dm_2",
                                                "REDO_DM_3"=>"$redo_dm_3",
                                                "REDO_DM_4"=>"$redo_dm_4",
                                                "REDO_DM_5"=>"$redo_dm_5"
					                          ),"DM_ID = '$dm_id_f'",$conn);
        if($result_edit){
            if (count($_FILES["dm_files"]) > 0) {
              $folderName = "files/dm_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["dm_files"]["name"]); $i++) {
                if ($_FILES["dm_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["dm_files"]["name"][$i])));
                  //$name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["dm_files"]["name"][$i];
                  $array_last=explode(".",$_FILES["dm_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_DM.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["dm_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$dm_id_f",
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
