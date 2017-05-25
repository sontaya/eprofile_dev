<?php
@session_start();

$fpath = '../';
require_once($fpath . "includes/connect.php");

// Query Admin position
//$sql = "SELECT CWK_MUA_MPOS,CWK_MUA_MAIN, CWK_MUA_SUBMAIN FROM CURRENT_WORK_TAB ";
//$sql .= "WHERE EMP_ID = '{$_SESSION['USER_EMP_ID']}' ";
//$sst = oci_parse($conn,$sql);
//oci_execute($sst);
//$rc = oci_fetch_array($sst);
/*
  echo "<pre>";
  echo "\$sql = {$sql}<br />";
  print_r($rc);
  echo "</pre>";
 */
$add_sql = " SDU_CURRENT_WORK_TAB.EMP_ID = SDU_BIODATA_TAB.EMP_ID ";
$add_sql2 = " SDU_CURRENT_WORK_TAB.EMP_ID = SDU_NAME_HISTORY.EMP_ID ";


if ($_SESSION['USER_TYPE'] == 'chief') {
  if ($_SESSION['CWK_MUA_MPOS'] == '02') { // ระดับรองอธิการบดี ไม่ให้ค้นหาข้อมูลระดับอธิการบดี
    $add_sql .= "AND SDU_CURRENT_WORK_TAB.CWK_MUA_MPOS <> '01' ";
  }

  if ($_SESSION['CWK_MUA_MPOS'] == '03' || $_SESSION['CWK_MUA_MPOS'] == '06' || $_SESSION['CWK_MUA_MPOS'] == '07' || $_SESSION['CWK_MUA_MPOS'] == '04' || $_SESSION['CWK_MUA_MPOS'] == '05') {
    // ผู้บริหารระดับ คณบดี 03 / รองคณบดี 06 / ผู้อำนวยการ 07 / หัวหน้าหน่วยงาน 04

    $add_sql .= " AND SDU_CURRENT_WORK_TAB.CWK_MUA_MAIN = '{$_SESSION['CWK_MUA_MAIN']}'  ";
    $add_sql2 .= "  AND SDU_CURRENT_WORK_TAB.CWK_MUA_MAIN = '{$_SESSION['CWK_MUA_MAIN']}'  ";

    if ($_SESSION['CWK_MUA_MPOS'] == '05') { // ผู้ช่วยอธิการบดี
      $add_sql .= "AND SDU_CURRENT_WORK_TAB.CWK_MUA_MPOS NOT IN ('01','02') ";
    }

    if ($_SESSION['CWK_MUA_MPOS'] == '06') { // รองคณบดี
      $add_sql .= "AND SDU_CURRENT_WORK_TAB.CWK_MUA_MPOS NOT IN ('01','02','03','05','07') ";
    }

    if ($_SESSION['CWK_MUA_MPOS'] == '04') { // หัวหน้าหน่วยงาน
      $add_sql .= " AND SDU_CURRENT_WORK_TAB.CWK_MUA_SUBMAIN = '{$_SESSION['CWK_MUA_SUBMAIN']}' AND SDU_CURRENT_WORK_TAB.CWK_MUA_MPOS NOT IN ('01','02','05','03','07') ";
      $add_sql2 .= " AND SDU_CURRENT_WORK_TAB.CWK_MUA_SUBMAIN = '{$_SESSION['CWK_MUA_SUBMAIN']}' ";
    }

    if ($_SESSION['CWK_MUA_MPOS'] == '03') { // คณบดี
      $add_sql .= "AND SDU_CURRENT_WORK_TAB.CWK_MUA_MPOS NOT IN ('01','02','05') ";
    }
  } // End if
} // End of ----->  if($_SESSION['USER_TYPE'] == 'chief')

$name = trim($_POST["name"]);
$mname = trim($_POST["mname"]);
$lastname = trim($_POST["lastname"]);
$emp_id = trim($_POST["emp_id"]);
$person_id = trim($_POST["person_id"]);
$emp_type = trim($_POST['emp_type']);
if ($name != "") {
  $where[] = " SDU_BIODATA_TAB.BIO_FNAME_TH LIKE '%$name%'  ";
  $where2[] = "  SDU_NAME_HISTORY.NAME LIKE '%$name%'  ";
}
if ($lastname != "") {
  $where[] = " SDU_BIODATA_TAB.BIO_LNAME_TH LIKE '%$lastname%' ";
  $where2[] = "  SDU_NAME_HISTORY.LAST_NAME LIKE '%$lastname%'   ";
}
if ($emp_id != "") {
  $where[] = " SDU_BIODATA_TAB.EMP_ID LIKE '%$emp_id%' ";
}
if ($person_id != "") {
  $where[] = " SDU_BIODATA_TAB.PERSON_ID LIKE '%$person_id%' ";
}

$where[] = $add_sql;
$where2[] = $add_sql2;

$where_size = count($where);
$where_size2 = count($where2);
$q_where = "";
$q_where2 = "";
for ($i = 0; $i < $where_size; $i++) {
  $q_where .= "$where[$i] AND ";

  if ($where_size == ($i + 1)) {
    $q_where = substr($q_where, 0, -4); // remove the last " OR AND";
  }
}

for ($i = 0; $i < $where_size2; $i++) {
  $q_where2 .= "$where2[$i] AND ";

  if ($where_size2 == ($i + 1)) {
    $q_where2 = substr($q_where2, 0, -4); // remove the last " OR AND";
  }
}

$q_where .= " AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE LIKE '%{$emp_type}%' ";

$q_where2 .= " AND SDU_CURRENT_WORK_TAB.CWK_MUA_EMP_TYPE LIKE '%{$emp_type}%' ";
//echo "<p>1: {$q_where}<br />2: {$q_where2}</p>"	;

$n = 0;
$num = 0;
$dont_find_old_name = 0;

$num = $db->count_row("SDU_BIODATA_TAB, SDU_CURRENT_WORK_TAB ", " WHERE $q_where  ", $conn);

if ($emp_id != "" or $person_id != "") {
  $dont_find_old_name = 1;
}

if ($dont_find_old_name == 0 and $num == 0) {
  $check_row = $db->count_row("SDU_BIODATA_TAB, SDU_NAME_HISTORY , SDU_CURRENT_WORK_TAB ", " WHERE $q_where2  ", $conn);
//print $check_row;
  if ($check_row > 0) {
    //$sql = "SELECT BIODATA_TAB.*,NAME_HISTORY.*,CURRENT_WORK_TAB.* FROM BIODATA_TAB, NAME_HISTORY, CURRENT_WORK_TAB WHERE $q_where2 ";
    $sql = "SELECT SDU_BIODATA_TAB.*,SDU_NAME_HISTORY.*,SDU_CURRENT_WORK_TAB.* FROM (SDU_CURRENT_WORK_TAB INNER JOIN SDU_BIODATA_TAB ON SDU_CURRENT_WORK_TAB.EMP_ID = SDU_BIODATA_TAB.EMP_ID) INNER JOIN  SDU_NAME_HISTORY ON SDU_CURRENT_WORK_TAB.EMP_ID =  SDU_NAME_HISTORY.EMP_ID  WHERE $q_where2 ";
    //echo ">".$sql;
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);
    ?>

    <!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
          	<link rel="stylesheet" type="text/css" href="../css/form.css" />-->

    <table width="716"  border="0" align="center"  bgcolor="#e9e9e9" >
      <tr align="center" class="text_th">
        <td width="52" class="text_tr">ลำดับ</td>
        <td width="150" class="text_tr">ชื่อ - นามสกุล</td>
        <td width="150" class="text_tr">เลขประจำตัวประชาชน </td>
        <td width="51" class="text_tr">แก้ไข</td>
      </tr>
      <?
      while (($row = oci_fetch_array($stid, OCI_BOTH))) {
        ++$n;
        ?>
        <tr align="center" height="22" valign="top">
          <td align="center" class="text_td"><?= $n ?></td>
          <td align="left" class="text_td text_data"><?= $row["NAME"] ?> <?= $row["LAST_NAME"] ?> (ชื่อเดิม)</td>
          <td align="center" class="text_td"><?= $row["EMP_ID"] ?></td>
          <td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer"  onclick="edit_('<?= $row["EMP_ID"] ?>');" title="Edit" class="vtip" /></td>
        </tr>
        <?
      }
    }
    else
      echo "- ไม่มีข้อมูล - "; // 0
  }else {

    $check_row = $db->count_row("SDU_BIODATA_TAB, SDU_CURRENT_WORK_TAB ", " WHERE $q_where  ", $conn);
    if ($check_row > 0) {
      $sql = "SELECT SDU_BIODATA_TAB.*,SDU_CURRENT_WORK_TAB.EMP_ID,SDU_CURRENT_WORK_TAB.CWK_STATUS FROM SDU_BIODATA_TAB,SDU_CURRENT_WORK_TAB WHERE $q_where ORDER BY BIO_FNAME_TH ASC  ";
//echo $sql;
      $stid = oci_parse($conn, $sql);
      oci_execute($stid);
      ?>

      <!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
      <link rel="stylesheet" type="text/css" href="../css/form.css" />-->
      <table width="716"  border="0" align="center"  bgcolor="#e9e9e9" >
        <tr align="center" class="text_th">
          <td width="52" class="text_tr">ลำดับ</td>
          <td width="150" class="text_tr">ชื่อ - นามสกุล</td>
            <td width="166" class="text_tr">หน่วยงานหลัก</td>
          <td width="166" class="text_tr">เลขบัตรบุคลากร </td>
          <td width="150" class="text_tr">เลขประจำตัวประชาชน </td>
          <td width="100" class="text_tr">สถานะ</td>
          <td width="51" class="text_tr">แก้ไข</td>
          <?php if ($_SESSION['USER_TYPE'] == 'hr' || $_SESSION['USER_TYPE'] == 'admin') { ?>
            <td class="text_tr">เปลี่ยนสิทธิ์</td>
          <?php } ?>
        </tr>
        <?
        while (($row = oci_fetch_array($stid, OCI_BOTH))) {
          ++$n;
          ?>
          <tr align="center" height="22" valign="top">
            <td align="center" class="text_td"><?= $n ?></td>
            <td align="left" class="text_td text_data"><?= $row["BIO_FNAME_TH"] ?>  <?= $row["BIO_MNAME_TH"] ?> <?= $row["BIO_LNAME_TH"] ?></td>
            <?  $stid1 = oci_parse($conn, "select * from FACULTY where CODE_FACULTY=".$row["BIO_RELIGION"]."");
                   oci_execute($stid1);
				    OCIFetch($stid1);
	               ?>
              <td align="left" class="text_td text_data"><?=ociresult($stid1, "NAME_FACULTY")?></td>
            <td align="center" class="text_td"><?= $row["EMP_ID"] ?></td>
            <td align="center" class="text_td"><?= $row["PERSON_ID"] ?></td>
            <td align="center" class="text_td"><?= get_cwk_status_name($row["CWK_STATUS"]) ?></td>
            <td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" onclick="edit_('<?= $row["EMP_ID"] ?>');" title="Edit" class="vtip" /></td> 
            <?php
            if ($_SESSION['USER_TYPE'] == 'hr' || $_SESSION['USER_TYPE'] == 'admin') {
              $sql2 = "SELECT * FROM  " . TB_USER_TAB . " WHERE EMP_ID = '{$row["EMP_ID"]}' ";

              $row2 = $db->fetch($sql2, $conn);
              
              if($row2['USER_TYPE']){ $usertype = $row2['USER_TYPE'];}else {$usertype = 'user'; } 
              ?>
              <td align="center" class="text_td"><span style="cursor:pointer" onclick="change_permit('<?php echo $row['EMP_ID']; ?>','<?php echo $row['BIO_FNAME_TH'] . "&nbsp;" . $row['BIO_LNAME_TH']; ?>','<?=$usertype?>')"><img src="../images/1304047760_kgpg_identity.png" border="0" height="15" /></span></td>
            <?php } ?>
          </tr>
          <?
        }
      }else
        echo "- ไม่มีข้อมูล -"; // 0
      if ($check_row > 0) {
        ?>

      </table>
      <div id="change_permit_dialog" style="display:none;" title="เปลี่ยนสิทธิ์ผู้ใช้งาน">
          	ผู้ใช้งาน : <span id="user_permit_name"></span><br />
        เลขบัตรบุคลากร : <span id="user_permit_empid"></span><br />
        สิทธิการใช้งาน : <select id="user_permit_value" name="user_permit_value" style="border:1px solid #999">
          <option value="user">ผู้ใช้งานทั่วไป</option>
          <option value="chief">หัวหน้าหน่วยงาน</option>
          <option value="hr">เจ้าหน้าที่ฝ่ายทรัพยากรบุคคล</option>
          <option value="admin">ผู้ดูแลระบบ</option>
          <option value="finance">การเงิน</option>
        </select>
      </div>
      <?
    }
  }

  function get_cwk_status_name($status) {
    if ($status == "01")
      return "ปฏิบัติการ";
    if ($status == "02")
      return "ลาออก";
    if ($status == "03")
      return "ลาศึกษาต่อ";
    if ($status == "04")
      return "เกษียนอายุ";
    if ($status == "05")
      return "ปฏิบัติการตามวาระ";
    if ($status == "07")
      return "เสียชีวิต";
    if ($status == "08")
      return "ไม่ได้ใช้งานแล้ว";
  }

  $db->closedb($conn);
  ?>