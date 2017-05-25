<?
include("../includes/connect.php");
$table = $_POST['table'];

$table = str_replace("user_tab","",$table);
$table =str_replace("{","'",$table);
$table =str_replace("}","'",$table);
$sql = "SELECT emp_id FROM sdu_education_support WHERE  $table ";
//print $sql."<br>";
$resource = oci_parse($conn, $sql);


$result = oci_execute($resource);
?>
<table border="1" style="border-collapse:collapse" class="all_table" >
  <tr style="background-color: #ffcccc">
    <th width="150"> ลำดับ</th>
    <th width="300"> ชื่อ-นามสกุล</th>
    <th width="300"> หน่วยงานหลัก</th>
    <th width="300"> หน่วยงานย่อย</th>
    <th width="300"> กลุ่ม</th>
  </tr>
<?
$i = 1; while ($row = oci_fetch_array($resource, OCI_BOTH)) {
?>
  <tr>
    <td align="center"><?= $i++ ?></td>
    <td align="left" style="padding-left: 6px;"><?= get_name($row['EMP_ID'], TB_BIODATA_TAB) ?></td>
    <td align="left" style="padding-left: 6px;"><?= get_main_sector($row['EMP_ID']) ?></td>
    <td align="left" style="padding-left: 6px;"><?= get_sub_sector($row['EMP_ID']) ?></td>
    <td align="left" style="padding-left: 6px;"><?= get_group($row['EMP_ID']) ?></td>
  </tr>
<?
}
if ($i == 1) {
?>
  <tr>
    <td align="center" colspan="5">... ไม่มีข้อมูล ...</td>
  </tr>
<? }  ?>
</table>