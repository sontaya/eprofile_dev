<?
$emp_id = $_REQUEST['emp_id'];
$fpath = '../';
require_once($fpath . "includes/connect.php");
$num = $db->count_row(TB_BIODATA_TAB, " WHERE  EMP_ID = '" . $emp_id . "' ", $conn);
if ($num > 0) {
  $sql = "SELECT * FROM  " . TB_BIODATA_TAB . "  WHERE  EMP_ID = '" . $emp_id . "'";
  $stid = oci_parse($conn, $sql);
  oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_BOTH);

  $sql2 = "SELECT * FROM  " . TB_CURRENT_WORK_TAB . "  WHERE  EMP_ID = '" . $emp_id . "'";
  $stid2 = oci_parse($conn, $sql2);
  oci_execute($stid2);
  $row2 = oci_fetch_array($stid2, OCI_BOTH);
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Print</title>
      <style type="text/css">
        <!--
        .out {
          margin-left: 0px;
          margin-top: 0px;
          margin-right: 0px;
          margin-bottom: 0px;
          /*background-image:url(../images/card.jpg);*/
          background-repeat:no-repeat;
          width: 1000px;
          height: 1412px;
        }
        body,td,th {
          font-family: Tahoma, Geneva, sans-serif;
        }
        -->
      </style></head>

    <body>

      <div align="left" class="out">
        <img src="../images/card.jpg"  />
        <img src="files/bio_data_file/<?= $row["BIO_PIC_FILE"] ?>"  style="width:135px; height:159px; border: 0px ; position: absolute; top: 261px; left: 214px; "/>
        <div style="width:170px; height:25px; border: 0px ; position: absolute; top: 422px; left: 199px; text-align:center; font-size: 22px;"><? echo $row["EMP_ID"]; ?></div>
        <div style="width:250px; height:22px; border: 0px ; position: absolute; top: 459px; left: 160px; text-align:center; font-size: 14px;"><? echo get_fullname($emp_id); ?></div>
        <div style="width:260px; height:22px; border: 0px ; position: absolute; top: 488px; left: 155px; text-align:center; font-size: 14px;"><? echo get_department($row2['CWK_MUA_MAIN'], TB_REF_DEPARTMENT); ?></div>
        <div style="width:260px; height:43px; border: 0px ; position: absolute; top: 520px; left: 155px; text-align:center; font-size: 14px;"><img src="../barcodegen/html/image.php?code=code39&o=1&dpi=72&t=30&r=1&rot=0&text=<?=  str_replace('-', '045', $emp_id)?>&f1=-1&f2=60&a1=&a2=&a3=" border="0" height="35"/></div>
        <div style="width:100px; height:22px; border: 0px ; position: absolute; top: 837px; left: 290px;  font-size: 14px;"><? echo date("d/m/Y") ?></div>
        <div style="width:220px; height:22px; border: 0px ; position: absolute; top: 340px; left: 450px; "><input type="button" value="&nbsp; &nbsp; Print&nbsp; &nbsp; " onclick="window.print() " /> <input type="button" value="&nbsp; &nbsp; Close&nbsp; &nbsp; " onclick="window.close() " /> </div>
      </div>  
    </body>
  </html>
<?
} else {

  echo "<h2 align='center'>ไม่มีบุคคลนี้อยู่ในระบบ <br /> <br /><input type=\"button\" value=\"&nbsp; &nbsp; Close&nbsp; &nbsp; \" onclick=\"window.close() \" /></h2>";
}
$db->closedb($conn);
?>