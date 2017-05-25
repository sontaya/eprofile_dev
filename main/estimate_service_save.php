<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";

    
$es_id_f = $_POST["es_id"];
$rate_year = $_POST["rate_year"];
$episode_no = $_POST["episode_no"]; 
$name_rate = $_POST["name_rate"];
$pis_rate = $_POST["pis_rate"];
    
$p_sdu_one = $_POST["p_sdu_one"];
$achieve_one = $_POST["achieve_one"];
$achieve_quantity_one = $_POST["achieve_quantity_one"];
    
$achieve_two = $_POST["achieve_two"];
$achieve_quantity_two = $_POST["achieve_quantity_two"];
    
$achieve_tree = $_POST["achieve_tree"];
$achieve_quantity_tree = $_POST["achieve_quantity_tree"];
    
$p_sdu_two = $_POST["p_sdu_two"];
$quantity_fig_1 = $_POST["quantity_fig_1"];
$quantity_new_1 = $_POST["quantity_new_1"];
    
$quantity_fig_2 = $_POST["quantity_fig_2"];
$quantity_new_2 = $_POST["quantity_new_2"];
    
$quantity_fig_3 = $_POST["quantity_fig_3"];
$quantity_new_3 = $_POST["quantity_new_3"];
    
$quantity_fig_4 = $_POST["quantity_fig_4"];
$quantity_new_4 = $_POST["quantity_new_4"];
    
$quantity_fig_5 = $_POST["quantity_fig_5"];
$quantity_new_5 = $_POST["quantity_new_5"];
    
$quantity_fig_6 = $_POST["quantity_fig_6"];
$quantity_new_6 = $_POST["quantity_new_6"];
    
$quantity_fig_7 = $_POST["quantity_fig_7"];
$quantity_new_7 = $_POST["quantity_new_7"];
    
$quantity_fig_8 = $_POST["quantity_fig_8"];
$quantity_new_8 = $_POST["quantity_new_8"];
    
$quantity_fig_9 = $_POST["quantity_fig_9"];
$quantity_new_9 = $_POST["quantity_new_9"];
    
$quantity_fig_10 = $_POST["quantity_fig_10"];
$quantity_new_10 = $_POST["quantity_new_10"];
    
$quantity_fig_11 = $_POST["quantity_fig_all"];
$quantity_new_11 = $_POST["quantity_new_all"];
    
$sdu_quantity_fig_one = $_POST["sdu_quantity_fig_one"];
$sdu_quantity_new_one = $_POST["sdu_quantity_new_one"];
    
$sdu_quantity_fig_two = $_POST["sdu_quantity_fig_two"];
$sdu_quantity_new_two = $_POST["sdu_quantity_new_two"];
    
$level_quantity = $_POST["level_quantity"];

$noet_one = $_POST["noet_one"];
$noet_two = $_POST["noet_two"];
    
$quantity_fig_now_one = $_POST["quantity_fig_now_one"];
$quantity_new_now_one = $_POST["quantity_new_now_one"];
    
$date_create = date("Y-m-d");

$pags_id = $_POST["pags_id"];

if($es_id_f == "" ){
        $es_id = auto_increment("ES_ID",TB_SDU_ESTIMATE_SERVICE_TAB);
		$result_add=$db->add_db(TB_SDU_ESTIMATE_SERVICE_TAB,array(
                                                    "EMP_ID"=>"$emp_id",
                                                    "ES_ID"=>"$es_id",
                                                    "RATE_YEAR"=>"$rate_year",
                                                    "EPISODE_NO"=>"$episode_no", 
                                                    "NAME_RATE"=>"$name_rate", 
                                                    "PIS_RATE"=>"$pis_rate", 
                                                    "P_SDU_ONE"=>"$p_sdu_one",
            
                                                    "ACHIEVE_ONE"=>"$achieve_one",
                                                    "ACHIEVE_QUANTITY_ONE"=>"$achieve_quantity_one ",    
                                                    "ACHIEVE_TWO"=>"$achieve_two", 
                                                    "ACHIEVE_QUANTITY_TWO"=>"$achieve_quantity_two",    
                                                    "ACHIEVE_TREE"=>"$achieve_tree", 
                                                    "ACHIEVE_QUANTITY_TREE"=>"$achieve_quantity_tree",
            
                                                    "P_SDU_TWO"=>"$p_sdu_two", 
                                                    "QUANTITY_FIG_1"=>"$quantity_fig_1", 
                                                    "QUANTITY_NEW_1"=>"$quantity_new_1",     
                                                    "QUANTITY_FIG_2"=>"$quantity_fig_2", 
                                                    "QUANTITY_NEW_2"=>"$quantity_new_2",
            
                                                    "QUANTITY_FIG_3"=>"$quantity_fig_3", 
                                                    "QUANTITY_NEW_3"=>"$quantity_new_3",    
                                                    "QUANTITY_FIG_4"=>"$quantity_fig_4", 
                                                    "QUANTITY_NEW_4"=>"$quantity_new_4",    
                                                    "QUANTITY_FIG_5"=>"$quantity_fig_5", 
                                                    "QUANTITY_NEW_5"=>"$quantity_new_5",
            
                                                    "QUANTITY_FIG_6"=>"$quantity_fig_6", 
                                                    "QUANTITY_NEW_6"=>"$quantity_new_6",     
                                                    "QUANTITY_FIG_7"=>"$quantity_fig_7", 
                                                    "QUANTITY_NEW_7"=>"$quantity_new_7",    
                                                    "QUANTITY_FIG_8"=>"$quantity_fig_8", 
                                                    "QUANTITY_NEW_8"=>"$quantity_new_8",
            
                                                    "QUANTITY_FIG_9"=>"$quantity_fig_9", 
                                                    "QUANTITY_NEW_9"=>"$quantity_new_9",    
                                                    "QUANTITY_FIG_10"=>"$quantity_fig_10", 
                                                    "QUANTITY_NEW_10"=>"$quantity_new_10",    
                                                    "QUANTITY_FIG_11"=>"$quantity_fig_11", 
                                                    "QUANTITY_NEW_11"=>"$quantity_new_11", 
            
                                                    "SDU_QUANTITY_FIG_ONE"=>"$sdu_quantity_fig_one", 
                                                    "SDU_QUANTITY_NEW_ONE"=>"$sdu_quantity_new_one",    
                                                    "SDU_QUANTITY_FIG_TWO"=>"$sdu_quantity_fig_two", 
                                                    "SDU_QUANTITY_NEW_TWO"=>"$sdu_quantity_new_two",    
                                                    "LEVEL_QUANTITY"=>"$level_quantity", 
            
                                                    "NOET_ONE"=>"$noet_one", 
                                                    "NOET_TWO"=>"$noet_two",   
                                                    "DATE_CREATE"=>"$date_create",
                                                    "QUANTITY_FIG_NOW_ONE"=>"$quantity_fig_now_one",
                                                    "QUANTITY_NEW_NOW_ONE"=>"$quantity_new_now_one"
											  ),$conn);
            if($result_add){
            if (count($_FILES["es_files"]) > 0) {
              $folderName = "files/es_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["es_files"]["name"]); $i++) {
                if ($_FILES["es_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["st_files"]["name"][$i])));
                  //$name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["da_files"]["name"][$i]; 
                  $array_last=explode(".",$_FILES["es_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_ES.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["es_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$es_id",
                                                "ID_PAGS"=>"$pags_id"
											  ),$conn);
                     $counter++;
                   }
                }
              }
            }
            ?>
            <script language="javascript">
            window.top.change_data('estimate_service.php?','../images/head2/work_data/estimate_service.png');
            </script>
            <?
            
        }
       
	}else{
		$result_edit=$db->update_db(TB_SDU_ESTIMATE_SERVICE_TAB,array(
                                                    "RATE_YEAR"=>"$rate_year",
                                                    "EPISODE_NO"=>"$episode_no", 
                                                    "NAME_RATE"=>"$name_rate", 
                                                    "PIS_RATE"=>"$pis_rate", 
                                                    "P_SDU_ONE"=>"$p_sdu_one", 
                                                    "ACHIEVE_ONE"=>"$achieve_one",
                                                    "ACHIEVE_QUANTITY_ONE"=>"$achieve_quantity_one ",    
                                                    "ACHIEVE_TWO"=>"$achieve_two", 
                                                    "ACHIEVE_QUANTITY_TWO"=>"$achieve_quantity_two",    
                                                    "ACHIEVE_TREE"=>"$achieve_tree", 
                                                    "ACHIEVE_QUANTITY_TREE"=>"$achieve_quantity_tree",   
                                                    "P_SDU_TWO"=>"$p_sdu_two", 
                                                    "QUANTITY_FIG_1"=>"$quantity_fig_1", 
                                                    "QUANTITY_NEW_1"=>"$quantity_new_1",     
                                                    "QUANTITY_FIG_2"=>"$quantity_fig_2", 
                                                    "QUANTITY_NEW_2"=>"$quantity_new_2",    
                                                    "QUANTITY_FIG_3"=>"$quantity_fig_3", 
                                                    "QUANTITY_NEW_3"=>"$quantity_new_3",    
                                                    "QUANTITY_FIG_4"=>"$quantity_fig_4", 
                                                    "QUANTITY_NEW_4"=>"$quantity_new_4",    
                                                    "QUANTITY_FIG_5"=>"$quantity_fig_5", 
                                                    "QUANTITY_NEW_5"=>"$quantity_new_5",     
                                                    "QUANTITY_FIG_6"=>"$quantity_fig_6", 
                                                    "QUANTITY_NEW_6"=>"$quantity_new_6",     
                                                    "QUANTITY_FIG_7"=>"$quantity_fig_7", 
                                                    "QUANTITY_NEW_7"=>"$quantity_new_7",    
                                                    "QUANTITY_FIG_8"=>"$quantity_fig_8", 
                                                    "QUANTITY_NEW_8"=>"$quantity_new_8",    
                                                    "QUANTITY_FIG_9"=>"$quantity_fig_9", 
                                                    "QUANTITY_NEW_9"=>"$quantity_new_9",    
                                                    "QUANTITY_FIG_10"=>"$quantity_fig_10", 
                                                    "QUANTITY_NEW_10"=>"$quantity_new_10",    
                                                    "QUANTITY_FIG_11"=>"$quantity_fig_11", 
                                                    "QUANTITY_NEW_11"=>"$quantity_new_11",    
                                                    "SDU_QUANTITY_FIG_ONE"=>"$sdu_quantity_fig_one", 
                                                    "SDU_QUANTITY_NEW_ONE"=>"$sdu_quantity_new_one",    
                                                    "SDU_QUANTITY_FIG_TWO"=>"$sdu_quantity_fig_two", 
                                                    "SDU_QUANTITY_NEW_TWO"=>"$sdu_quantity_new_two",    
                                                    "LEVEL_QUANTITY"=>"$level_quantity", 
                                                    "NOET_ONE"=>"$noet_one", 
                                                    "NOET_TWO"=>"$noet_two",   
                                                    "DATE_CREATE"=>"$date_create",
                                                    "QUANTITY_FIG_NOW_ONE"=>"$quantity_fig_now_one",
                                                    "QUANTITY_NEW_NOW_ONE"=>"$quantity_new_now_one"
					                          ),"ES_ID = '$es_id_f'",$conn);
            
            if($result_edit){
            if (count($_FILES["es_files"]) > 0) {
              $folderName = "files/es_file/";
              $counter = 0;
              for ($i = 0; $i < count($_FILES["es_files"]["name"]); $i++) {
                if ($_FILES["es_files"]["name"][$i] <> "") {

                  //$ext = strtolower(end(explode(".", $_FILES["st_files"]["name"][$i])));
                  //$name_fi= rand(10000, 990000) . '_' . time() . '.' .$_FILES["da_files"]["name"][$i]; 
                  $array_last=explode(".",$_FILES["es_files"]["name"][$i]);
	              $last=strtolower($array_last[count($array_last)-1]);
                  $name_fi= rand(10000, 990000) . '_' . time() . '_ES.' .$last; 
                  $filePath =$folderName .$name_fi;

                  if (move_uploaded_file($_FILES["es_files"]["tmp_name"][$i], $filePath)) {
                      $img_id = auto_increment("IMG_ID",TB_SDU_SECTOR_TRANSFER_IMG_TAB);
                      $re_add=$db->add_db(TB_SDU_SECTOR_TRANSFER_IMG_TAB,array(
                                                "EMP_ID"=>"$emp_id",
                                                "IMG_ID"=>"$img_id",
                                                "IMG_NAME"=>"$name_fi",
                                                "MAT_ID"=>"$es_id_f",
                                                "ID_PAGS"=>"$pags_id"
											  ),$conn);
                     $counter++;
                   }
                }
              }
            }
            ?>
            <script language="javascript">
            window.top.change_data('estimate_service.php?','../images/head2/work_data/estimate_service.png');
            </script>
            <?
            
        }

           
	}
    ?>
<script language="javascript">
    window.top.change_data('estimate_service.php?','../images/head2/work_data/estimate_service.png');
</script>
<?		
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
