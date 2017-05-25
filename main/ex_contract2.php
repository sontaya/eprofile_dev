<?
$fpath = '../';
require_once($fpath."includes/connect.php");
function GetPosition($pos){
	$strPos;
	switch ($pos){
		case '1' : 
			$strPos = "เจ้าหน้าที่";
			break;
		case '2' : 
			$strPos = "อาจารย์";
			break;
		case '3' : 
			$strPos = "ผศ.";
			break;
		case '4' : 
			$strPos = "รศ.";
			break;
		case '5' : 
			$strPos = "ศ.";
			break;
		case '6' : 
			$strPos = "ที่ปรึกษา";
			break;
		case '7' : 
			$strPos = "ครู";
			break;	
	}
	return $strPos;
}
?>

<div align="center">
  <h3>บุคลากรที่กำลังจะหมดสัญญาภายใน 180 วัน หรืออายุกำลังจะครบ 60 ปี</h3>
</div>
<table width="90%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <th width="41" align="center">ลำดับ</th>
    <th width="224" align="center">ชื่อ - นามสกุล</th>
    <th width="86" align="center">เลขที่สัญญา</th>
    <th width="256" align="center">วันที่เริ่ม - สิ้นสุด</th>
    <th width="96" align="center">วดป เกิด</th>
    <th width="147" align="center">ตำแหน่ง</th>
    <th width="147" align="center">ประเภท</th>
    <th width="32" align="center">&nbsp;</th>
  </tr>
  <?
 $n1 = 0;
 $today = date("Y-m-d");
 
 //$sql = "SELECT * FROM  ".TB_CONTRACT_TAB." WHERE SYSDATE-CONTRACT_FINISH <60 AND EMP_ID ='2007-065' ORDER BY CONTRACT_FINISH DESC";
// $sql = "SELECT * FROM  ".TB_CONTRACT_TAB." WHERE SYSDATE-CONTRACT_FINISH <60 /*AND EMP_ID ='2007-065' */ AND ROWNUM = 1   ORDER BY CONTRACT_NO DESC";
	$sql = "SELECT Query1.*, Query2.BIO_BIRTHDAY,Query3.CWK_STATUS FROM (
			SELECT * FROM (SELECT EMP_ID,CONTRACT_NO,CONTRACT_PERIOD,CONTRACT_YEAR,CONTRACT_POSITION,CONTRACT_START,CONTRACT_FINISH,
    		CONTRACT_M60,CONTRACT_EXPIRED,MAX(CONTRACT_NO) OVER (PARTITION BY EMP_ID) AS RMAX_CTN FROM ".TB_CONTRACT_TAB."))
			Query1
			LEFT JOIN SDU_BIODATA_TAB Query2
			ON Query1.EMP_ID = Query2.EMP_ID
            LEFT JOIN SDU_CURRENT_WORK_TAB Query3
			ON Query1.EMP_ID = Query3.EMP_ID
WHERE
    CONTRACT_NO = RMAX_CTN            
			ORDER BY Query1.CONTRACT_M60 DESC 
			";
			
//echo $sql;			
		$stid = oci_parse($conn, $sql );
		oci_execute($stid);
		while (($row = oci_fetch_array($stid, OCI_BOTH))) {
            if($row["CWK_STATUS"]=="01" || $row["CWK_STATUS"]=="03" || $row["CWK_STATUS"]=="05"){
			 
			 //$date_to_reach_60 = date("Y-m-d",strtotime(date2_formatdb(get_birthday($row['EMP_ID'],TB_BIODATA_TAB,false))." + 60 year"));
			 //$date_to_reach_60 = date("Y-m-d",strtotime(get_birthday($row['EMP_ID'],TB_BIODATA_TAB,false)." + 60 year"));
			 //list($day2,$month2,$year2) = explode("/",get_birthday($row['EMP_ID'],TB_BIODATA_TAB));
			 //list($year2,$month2,$day2) = explode('-',get_birthday($row['EMP_ID'],TB_BIODATA_TAB,false));
			 list($year2,$month2,$day2) = explode('-',$row['BIO_BIRTHDAY']);
			 $year2+=60;
			 $date_to_reach_60 = trim($year2.'-'.$month2.'-'.$day2);
			 
			 if($row['CONTRACT_M60'] == '0'){ // contract not more than 60 year
				  if( change_to_timestamp1($row['CONTRACT_FINISH']) > change_to_timestamp1($date_to_reach_60) ){ //"Contract Expired Date" more than "60 Years Date"
						$c = getdays($today,$date_to_reach_60); 
							if($c <= 60 && $c != -1){//Closing to expire
							
?>
  <tr>
    <td align="center" valign="top"><?=++$n1?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_name($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td align="center" valign="top" style='padding-left:7px'><?=$row['CONTRACT_NO']?></td>
    <td align="center" valign="top" style='padding-left:7px'><?=change_date_thai($row["CONTRACT_START"])?>
      ถึง
      <?=change_date_thai($row["CONTRACT_FINISH"])?></td>
    <td  align="center" valign="top"><?=change_date_thai($row["BIO_BIRTHDAY"]) /*get_birthday($row['EMP_ID'],TB_BIODATA_TAB)*/ ?></td>
    <td  align="center" valign="middle"><? echo GetPosition($row['CONTRACT_POSITION']); ?></td>
    <td  align="center" valign="middle"><b>อายุกำลังจะครบ 60 ปี</b></td>
    <td  align="center" valign="middle"><img src="../images/i.edit.png" style="cursor:pointer" onclick="new_contract('<?=$row['EMP_ID']?>','<?=$row['CONTRACT_NO']?>')"/></td>
  </tr>
  <?	
								
							}
					 }else{
						 $d = getdays($row['CONTRACT_FINISH'],date("Y-m-d"));
						 if($d < 180 && $d != -1) {
							 
?>
  <tr>
    <td align="center" valign="top"><?=++$n1?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_name($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td align="center" valign="top" style='padding-left:7px'><?=$row['CONTRACT_NO']?></td>
    <td align="center" valign="top" style='padding-left:7px'><?=change_date_thai($row["CONTRACT_START"])?>
      ถึง
      <?=change_date_thai($row["CONTRACT_FINISH"])?></td>
    <td  align="center" valign="top"><?=change_date_thai($row["BIO_BIRTHDAY"]) //get_birthday($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td  align="center" valign="middle"><? echo GetPosition($row['CONTRACT_POSITION']); ?></td>
    <td  align="center" valign="middle"><b>จะหมดสัญญาภายใน 180 วัน</b></td>
    <td  align="center" valign="middle"><img src="../images/i.edit.png" style="cursor:pointer" onclick="new_contract('<?=$row['EMP_ID']?>','<?=$row['CONTRACT_NO']?>')"/></td>
  </tr>
  <?							
							
						}
					 }
				}//end  if($row['CONTRACT_M60'] == '0')
				elseif($row['CONTRACT_M60'] == '1'){//contract more than 60 only
				$d = getdays(date("Y-m-d"),$row['CONTRACT_FINISH']);
					if($d < 365 && $d != -1) {//expired contract By Expired Date only

?>
  <tr>
    <td align="center" valign="top"><?=++$n1?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_name($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td align="center" valign="top" style='padding-left:7px'><?=$row['CONTRACT_NO']?></td>
    <td align="center" valign="top" style='padding-left:7px'><?=change_date_thai($row["CONTRACT_START"])?>
      ถึง
      <?=change_date_thai($row["CONTRACT_FINISH"])?></td>
    <td  align="center" valign="top"><?=change_date_thai($row["BIO_BIRTHDAY"]) //get_birthday($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td  align="center" valign="middle"><? echo GetPosition($row['CONTRACT_POSITION']); ?></td>
    <td  align="center" valign="middle"><b>อายุมากกว่า 60 ปี <br>จะหมดสัญญาภายใน 1 ปี</b></td>
    <td  align="center" valign="middle"><img src="../images/i.edit.png" style="cursor:pointer" onclick="new_contract('<?=$row['EMP_ID']?>','<?=$row['CONTRACT_NO']?>')"/></td>
  </tr>
  <?							
						
					}
				}//end if($row['CONTRACT_M60'] == '1')
            }
			
		}///end while
	//echo $n1;
	
if($n1 == 0){
echo "\n<tr><td colspan='6' align='center'><b>-------- ไม่มีข้อมูล --------</b></td></tr>\n";}	
	
	
	

?>
</table>
