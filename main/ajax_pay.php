<?
$fpath = '../';
require_once($fpath."includes/connect.php");
if($_POST["id"] == "") $where = "99999"; 
else $where = $_POST["id"];

 //$sql_ref_department_sub = "SELECT * FROM  ".TB_SDU_PAY_TAB."  WHERE CT_NO = '".$where."'"; 
	$sql_pay = "SELECT * FROM  " . TB_SDU_MUNNY_TAB . " WHERE EMP_ID = '" .$_SESSION["EMP_ID"]. "' and CT_NO='".$where."' ";
			$stid_pay = oci_parse($conn, $sql_pay);
			oci_execute($stid_pay);
			while ($row_pay = oci_fetch_array($stid_pay, OCI_BOTH)) {  
				 $cc=$row_pay["MUNNY_ALL"];
			}
			
	$sql_pay2 = "SELECT SUM(MUNNY_NUM) as MUNNY_NUM FROM  " . TB_SDU_PAY_TAB . " WHERE CT_NO='".$where."' ";
			$stid_pay2 = oci_parse($conn, $sql_pay2);
			oci_execute($stid_pay2);
			while ($row_pay2 = oci_fetch_array($stid_pay2, OCI_BOTH)) {  
				 $ww=$row_pay2["MUNNY_NUM"];
				//$pay="<input type='text' name='num_munny' id='num_munny' class='input_text' value='".$cc2."' "; 
			}
	?>
   
	<?=number_format($pay=$cc - $ww , 2 );?>
          


<?
$db->closedb($conn);
?>