<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";

    
$da_id_f = $_POST["da_id"];
$da_order_no = $_POST["da_order_no"];
$da_at = $_POST["da_at"];
if($_POST["da_at_date"] != "" ) $da_at_date = date2_formatdb($_POST["da_at_date"]);
    
$type_munny = $_POST["type_munny"];
$location_munny = $_POST["location_munny"];
$munny_da = $_POST["munny_da"];

    
if($_POST["start_dates"] != "" ) $start_dates = date2_formatdb($_POST["start_dates"]);
if($_POST["end_dates"] != "" ) $end_dates = date2_formatdb($_POST["end_dates"]);
$start_ck = $_POST["start_ck"];
$da_note = $_POST["da_note"];
    
echo $pags_id = $_POST["pags_id"];


if($da_id_f == "" ){
        $da_id = auto_increment("DA_ID",TB_SDU_DATA_ANSWER_TAB);
		$result_add=$db->add_db(TB_SDU_DATA_ANSWER_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "DA_ID"=>"$da_id",
                                                "DA_ORDER_NO"=>"$da_order_no",
                                                "DA_AT"=>"$da_at",
                                                "DA_AT_DATE"=>"$da_at_date",
            
                                                "TYPE_MUNNY"=>"$type_munny",
                                                "LOCATION_MUNNY"=>"$location_munny",
                                                "MUNNY_DA"=>"$munny_da",

                                                "START_DATES"=>"$start_dates",
                                                "END_DATES"=>"$end_dates",
                                                "START_CK"=>"$start_ck",
                                                "DA_NOTE"=>"$da_note"
            
											  ),$conn);
        if($result_add){
            if (count($_FILES["da_files"]) > 0) {
              $folderName = "files/da_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["da_files"]["name"]); $i++) {
                if ($_FILES["da_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["st_files"]["name"][$i])));
                  //$name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["da_files"]["name"][$i]; 
                  $array_last=explode(".",$_FILES["da_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_DA.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["da_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$da_id",
                                                "ID_PAGS"=>"$pags_id"
											  ),$conn);
                     $counter++;
                   }
                }
              }
            }
            ?>
            <script language="javascript">
            window.top.change_data('data_answer.php?','../images/head2/work_data/data_answer.png');
            </script>
            <?
            
        }
	}else{
		$result_edit=$db->update_db(TB_SDU_DATA_ANSWER_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "DA_ORDER_NO"=>"$da_order_no",
                                                "DA_AT"=>"$da_at",
                                                "DA_AT_DATE"=>"$da_at_date",
            
                                                "TYPE_MUNNY"=>"$type_munny",
                                                "LOCATION_MUNNY"=>"$location_munny",
                                                "MUNNY_DA"=>"$munny_da",

                                                "START_DATES"=>"$start_dates",
                                                "END_DATES"=>"$end_dates",
                                                "START_CK"=>"$start_ck",
                                                "DA_NOTE"=>"$da_note"
					                          ),"DA_ID = '$da_id_f'",$conn);
        echo $kk=count($_FILES["da_files"]);
        if($result_edit){
            if (count($_FILES["da_files"]) > 0) {
              $folderName = "files/da_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["da_files"]["name"]); $i++) {
                if ($_FILES["da_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["st_files"]["name"][$i])));
                  //$name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["da_files"]["name"][$i];
                  $array_last=explode(".",$_FILES["da_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_DA.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["da_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$da_id_f",
                                                "ID_PAGS"=>"$pags_id"
											  ),$conn);
                     $counter++;
                   }
                }
              }
            }
            
            ?>
            <script language="javascript">
            window.top.change_data('data_answer.php?','../images/head2/work_data/data_answer.png');
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
