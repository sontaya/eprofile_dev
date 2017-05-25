<?
include("./../includes/config.inc.php");
include("./../includes/connect.php");
ini_set('display_errors', '0');
/*
  define("DB_USERNAME","SDPERSON");//oracle username
  define("DB_PASSWORD","PERSON");// oracle password
  define("DB_HOST","10.202.1.13/RSDUE2M"); //ordacle host and global name
  define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)
  $conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
  /*
  $sql="SELECT * FROM RSDUHR.VSALARY";
  $stid = @oci_parse($conn, $sql );
  @oci_execute($stid);
  while($dbarr = @oci_fetch_array($stid, OCI_BOTH)){
  print ">>".$dbarr["ID_CARD"]."<br>";
  }
 */
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center>
  <script>
    function popup(emp){
	
      //var name=document.getElementById("name").value;
      //alert("uu");
      //var last_name=document.getElementById("last_name").value;
      //var emp_id=document.getElementById("emp_id").value;
      //var id_card=document.getElementById("id_card").value;
      //var emp_type=document.getElementById("emp_type").value;
	
      window.open("../salery/popup_salary_detail.php?emp="+emp,null,"height=300,width=500,status=yes,toolbar=no,menubar=no,scrollbars=yes");
    }
  </script>
  <?

  function sum_salary_n($emp_id) {
    global $conn;
    $sql = "SELECT SUM(SALARY_AMOUNT) FROM SDU_SALARY_MASTER WHERE CODE_PERSON='" . $emp_id . "' AND SALARY_TYPE_ID!='10'";
    $stid = @oci_parse($conn, $sql);
    @oci_execute($stid);
    $dbarr = @oci_fetch_array($stid, OCI_BOTH);
    return $dbarr[0];
  }

  $name = $_GET["name"];
  $last_name = $_GET["last_name"];
  $emp_id = $_GET["emp_id"];
  $id_card = $_GET["id_card"];
  $emp_type = $_GET["emp_type"];
  if ($_GET["name"] != "") {
    $sql_where[] = " SDU_BIODATA_TAB.BIO_FNAME_TH LIKE '%" . $name . "%'  ";
  }

  if ($_GET["last_name"] != "") {
    $sql_where[] = " SDU_BIODATA_TAB.BIO_LNAME_TH LIKE '%" . $last_name . "%' ";
  }

  if ($_GET["emp_id"] != "") {
    $sql_where[] = " SDU_BIODATA_TAB.EMP_ID LIKE '%" . $emp_id . "%' ";
  }

  if ($_GET["id_card"] != "") {
    $sql_where[] = " SDU_BIODATA_TAB.PERSON_ID LIKE '%" . $id_card . "%' ";
  }

  if ($_GET["emp_type"] != "") {
    $sql_where[] = " SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE LIKE '%{$emp_type}%' ";
  }

  $c = 0;
  foreach ($sql_where as $value) {
    if ($c > 0) {
      $sql2.=" AND ";
    }
    $sql2.=$value;
    $c++;
  }
//$sql2="SELECT SDU_BIODATA_TAB.*,SDU_CURRENT_WORK_TAB.*,RSDUHR.VSALARY.*,SDU_SALARY_STEP.* FROM SDU_BIODATA_TAB,SDU_CURRENT_WORK_TAB,RSDUHR.VSALARY,SDU_SALARY_STEP WHERE RSDUHR.VSALARY.ID_CARD=SDU_BIODATA_TAB.PERSON_ID AND SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID AND".$sql2." GROUP BY SDU_BIODATA_TAB.EMP_ID ";

  $sql3 = "SELECT SDU_BIODATA_TAB.*,SDU_CURRENT_WORK_TAB.*,RSDUHR.VSALARY.*,SDU_SALARY_STEP.* FROM ";
  $sql3.=" SDU_BIODATA_TAB INNER JOIN RSDUHR.VSALARY ON SDU_BIODATA_TAB.PERSON_ID=RSDUHR.VSALARY.ID_CARD ";
  $sql3.=" INNER JOIN SDU_CURRENT_WORK_TAB ON SDU_CURRENT_WORK_TAB.EMP_ID=SDU_BIODATA_TAB.EMP_ID ";
  $sql3.=" INNER JOIN SDU_SALARY_STEP ON SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID WHERE RSDUHR.VSALARY.ID_CARD=SDU_BIODATA_TAB.PERSON_ID AND  SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID AND" . $sql2 . " ORDER BY SDU_SALARY_STEP.REF DESC";

//SDU_CURRENT_WORK_TAB,RSDUHR.VSALARY,SDU_SALARY_STEP WHERE RSDUHR.VSALARY.ID_CARD=SDU_BIODATA_TAB.PERSON_ID AND SDU_SALARY_STEP.EMP_ID=SDU_BIODATA_TAB.EMP_ID AND".$sql2." GROUP BY SDU_BIODATA_TAB.EMP_ID ";
  //print $sql3;

  $stid = @oci_parse($conn, $sql3);
  @oci_execute($stid);
  $c = 0;
  $n_monery = 0;
  $a = 0;
  $emp_id = array();
  while ($dbarr = @oci_fetch_array($stid, OCI_BOTH)) {


    // if ref == ตัว max สุดให้แสดง
    $sql4 = "SELECT max(REF) as maxref FROM sdu_salary_step  WHERE emp_id = '{$dbarr['EMP_ID']}' ";
    $stid4 = @oci_parse($conn, $sql4);
    @oci_execute($stid4);
    $max = @oci_fetch_array($stid4, OCI_BOTH);

    
    
    

    if($max['MAXREF'] == $dbarr["REF"]){
  $c++;
    $emp_data[$dbarr["PERSON_ID"]]["salary_n"] = sum_salary_n($dbarr["EMP_ID"]);

    $emp_id[] = $dbarr["PERSON_ID"];
    $a++;
    $emp_data[$dbarr["PERSON_ID"]]["emp_id"] = $dbarr["EMP_ID"];
    $emp_data[$dbarr["PERSON_ID"]]["name"] = $dbarr["BIO_FNAME_TH"] . "&nbsp;&nbsp;" . $dbarr["BIO_LNAME_TH"];
    $emp_data[$dbarr["PERSON_ID"]]["account_no"] = $dbarr["ACCOUNT_NO"];


    $salary1 = $dbarr["SALARY1"] + $dbarr["SALARY2"] + $dbarr["SALARY3"];
    $total = $salary1 - $dbarr["SALARY"];
    if ($total) {
      $n_monery++;
    }

    $emp_data[$dbarr["PERSON_ID"]]["salary1"] = $salary1;
    $emp_data[$dbarr["PERSON_ID"]]["salary2"] = $dbarr["SALARY"];
    $emp_data[$dbarr["PERSON_ID"]]["total"] = $total;

    $sum_salary_ep = $salary1 + $sum_salary_ep;
    $sum_salary_es = $dbarr["SALARY"] + $sum_salary_es;
    }
  }

  $i = 1;
  ?>
  <table width="1100" style="font-size:12px;">
    <tr align="left">
      <td>ทั้งหมด <?= $c ?> คน</td>
      <td>ยอดเงินไม่เท่ากัน <?= $n_monery ?> คน</td>
      <td></td>
    </tr>
    <tr align="left">
      <td>รวมยอดเงิน E-profile <?= number_format($sum_salary_ep, 2) ?> บาท</td>
      <td>รวมยอดเงิน E-salary <?= number_format($sum_salary_es, 2) ?> บาท</td>
      <td>ผลต่าง <?= number_format(($sum_salary_ep - $sum_salary_es), 2) ?> บาท</td>
    </tr>
    <tr align="left">
      <td><samp style="background:#C1FFC1; width:30px;">&nbsp;&nbsp;</samp> คือ ผลต่างเท่ากัน</td>
      <td><samp style="background:#FF8080; width:30px;">&nbsp;&nbsp;</samp> คือ ผลต่างไม่เท่ากัน</td>
      <td></td>
    </tr>
  </table>
  <table width="1100">
    <tr align="center"  valign="top">
      <td>

        <table border="1" style="font-size:12px;" cellspacing="0">
          <tr align="center" style="font-weight:bold;">
            <td colspan="5" bgcolor="#ECF5FF">e-profile</td>
            <td colspan="5" bgcolor="#FFD6C1">e-salary</td>
          </tr>
          <tr align="center" style="font-weight:bold;">
            <td width="50" bgcolor="#ECF5FF">ลำดับที่</td>
            <td width="150" bgcolor="#ECF5FF">หมายเลขประชาชน</td>
            <td width="180" bgcolor="#ECF5FF">ชื่อ-นามสกุล</td>
            <td width="180" bgcolor="#ECF5FF">เงินอื่นๆ</td>
            <td width="150" bgcolor="#ECF5FF">เงินเดือน</td>

            <td width="150" bgcolor="#FFD6C1">หมายเลขประชาชน</td>
            <td width="180" bgcolor="#FFD6C1">ชื่อ-นามสกุล</td>
            <td width="150" bgcolor="#FFD6C1">หมายเลขบัญชี</td>
            <td width="150" bgcolor="#FFD6C1">เงินเดือน</td>
            <td width="150" bgcolor="#FFD6C1">ผลต่าง</td>
          </tr>
<?
foreach ($emp_id as $value) {
  //for($x=0;$x<=$a-1;$x++){
  //$value=$emp_id[0];
  //print ">>>".$value."<br>";
  //$salary1=$dbarr["SALARY1"]+$dbarr["SALARY2"]+$dbarr["SALARY3"];
  //$total=$salary1-$dbarr["SALARY"];
  //$sum_salary_ep=$salary1+$sum_salary_ep;
  //$sum_salary_es=$dbarr["SALARY"]+$sum_salary_es;
  ?>
            <tr>
              <td width="50" align="center" bgcolor="#ECF5FF"><?= $i ?></td>
              <td width="150" bgcolor="#ECF5FF"><?= $value ?></td>
              <td width="150" bgcolor="#ECF5FF"><a href="javascript:void();" onclick="popup('<?= $emp_data[$value]["emp_id"] ?>');"><?= $emp_data[$value]["name"] ?></a></td>
              <td width="150" align="right" bgcolor="#ECF5FF"><?= number_format($emp_data[$value]["salary_n"], 2) ?></td>
              <td width="150" align="right" bgcolor="#ECF5FF"><font style="color:#0000CC; font-weight:bold;"><?= number_format($emp_data[$value]["salary1"], 2) ?></font></td>

              <td width="150" bgcolor="#FFD6C1"><?= $value ?></td>
              <td width="150" bgcolor="#FFD6C1"><?= $emp_data[$value]["name"] ?></td>
              <td width="150" align="center" bgcolor="#FFD6C1"><?= $emp_data[$value]["account_no"] ?>&nbsp;</td>
              <td width="150" align="right" bgcolor="#FFD6C1"><?= number_format($emp_data[$value]["salary2"], 2) ?></td>
  <?
  if ($emp_data[$value]["total"] == 0) {
    $bg = "#C1FFC1";
  } else {
    $bg = "#FF8080";
  }
  ?>
              <td bgcolor="<?= $bg ?>" width="150" align="right"><?= number_format($emp_data[$value]["total"], 2) ?></td>
            </tr>
              <? $i++; } ?>  
      <!--	<tr>
              <td colspan="3" align="center" style=" font-weight:bold">รวม</td>
              <td align="right"><?= number_format($sum_salary_ep, 2) ?></td>
              <td colspan="3" align="center" style=" font-weight:bold">รวม</td>
              <td align="right"><?= number_format($sum_salary_es, 2) ?></td>
              <td align="right"><?= number_format(($sum_salary_ep - $sum_salary_es), 2) ?></td>
          </tr> -->
        </table>

      </td>
    </tr>
  </table>
  <a href="popup_salary_excel.php?name=<?= $name ?>&last_name=<?= $last_name ?>&emp_id=<?= $_GET["emp_id"] ?>&id_card=<?= $id_card ?>&emp_type=<?= $emp_type ?>">Excel</a>
</center>