<?
@session_start();
print_r($_POST);
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";

$txtremark = htmlspecialchars($_POST["data_remark"]);
$assessment_year1 = $_POST["assessment_year1"];
$result_edit=$db->update_db("SDU_RAISE_SALARY",array(
									  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
									  "ASSESSMENT_REMARK"=>"$txtremark",
									  "UPDATE_BY"=>"$update_user",
									  ),"EMP_ID = '$emp_id'", $conn);
									  
            ?>
            <script language="javascript">
            window.top.change_data('data_answer.php?','../images/head2/work_data/data_answer.png');
            </script>
            <?
$db->closedb($conn);
?>
<script language="javascript">
//var ran=Math.random();
window.top.$("span#waiting").html("");
//window.top.load_page("data_answer.php?"+ran);
</script>
<?
}
?>