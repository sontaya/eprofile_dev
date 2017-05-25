<?

if($_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=sdu_report_".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
include("../includes/connect.php");
function re_hyphen($n){
	if($n == 0) return "-";
	else return number_format($n,0);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ข้อมูลอาจารย์มหาวิทยาลัยราชภัฎสวนดุสิต</title>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.6.custom.min.js"></script>

    <script type="text/javascript">
      $(function() {
        $.fx.speeds._default = 1000;
        $( "#dialog" ).dialog({
          autoOpen: false,
          show: "blind",
          width: "700"
        });

        $( "#opener" ).click(function() {
          $( "#dialog" ).dialog( "open" );
          return false;
        });
      });
      function openModal(table){
        $("#dialog").load("views_sdu_teacher", { 'table': table } );
        $("#dialog" ).dialog( "open" );
      }
    </script>
    <style type="text/css">
      body,td,th {
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 12px;
      }

      .all_table{
        border: #000 2px solid ;
      }
      .th{
        border-bottom: #000 2px solid ;
        border-right: #000 2px solid ;
      }
      .th2{
        border-bottom: #000 2px solid ;
      }
      .fac{
        border-bottom:  solid 1px #666 ;
        border-right: #000 2px solid ;
        padding-bottom: 5px;
      }
      .fac2{
        border-right: #000 2px solid ;
        padding-bottom: 5px;
      }

      .fac3{

        font-weight:bold;
      }

      .data{
        border-bottom:  solid 1px #666 ;
        border-right: #666 1px solid ;
        padding-bottom: 5px;
      }
      .data2{
        border-bottom:  solid 1px #666 ;
        border-right: #000 2px solid ;
        padding-bottom: 5px;
        font-weight:bold;
      }
      .data3{
        border-right: #000 2px solid ;
        padding-bottom: 5px;
      }
      .data4{
        border-right: #000 1px solid ;
        padding-bottom: 5px;
      }
      .data22{
        border-bottom:  solid 1px #666 ;
        padding-bottom: 5px;
        font-weight:bold;
      }
      .data222{
        border-right: #666 1px solid ;
        padding-bottom: 5px;
      }
    </style>
  </head>

  <body>
    <div align="center" style="font-size:14px;" >ข้อมูลอาจารย์มหาวิทยาลัยราชภัฎสวนดุสิต <br /><br /> ปีการศึกษา <? echo date("Y") + 543; ?><br /><br /> ข้อมูล ณ วันที่ <? echo date("d") . " " . get_month_full(date("m")) . " " . (date("Y") + 543); ?><br />
      <br />
    </div>
   <table  cellspacing="0" cellpadding="2" class="all_table" align="center">
      <tr>
        <td width="160" rowspan="3" align="center" valign="middle" class="th">หน่วยงาน</td>
        <td width="43" rowspan="3" align="center" valign="middle" class="th">จำนวน<br />ทั้งหมด</td>
        <td height="33" colspan="9" align="center" valign="middle" class="th">ข้าราชการ</td>
        <td colspan="9" align="center" valign="middle" class="th">อาจารย์ประจำตามสัญญาจ้าง</td>
        <td colspan="9" align="center" valign="middle" class="th">พนักงานมหาวิทยาลัย</td>
        <td colspan="9" align="center" valign="middle" class="th">พนักงานราชการ</td>
        <td colspan="9" align="center" valign="middle" class="th2">รวมบุคลากรทั้งหมด</td>
      </tr>
      <tr>
        <td height="33" colspan="3" align="center" valign="middle" class="th">วุฒิปริญญา</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td height="33" colspan="3" align="center" valign="middle" class="th">วุฒิปริญญา</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td height="33" colspan="3" align="center" valign="middle" class="th">วุฒิปริญญา</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td height="33" colspan="3" align="center" valign="middle" class="th">วุฒิปริญญา</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td height="33" colspan="3" align="center" valign="middle" class="th">วุฒิปริญญา</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th">รวม</td>
        <td colspan="4" align="center" valign="middle" class="th">ตำแหน่งทางวิชาการ</td>
        <td width="22" rowspan="2" align="center" valign="middle" class="th2">รวม</td>
      </tr>
      <tr>
        <td width="22" height="32" align="center" valign="middle" class="th">เอก</td>
        <td width="22" align="center" valign="middle" class="th">โท</td>
        <td width="22" align="center" valign="middle" class="th">ตรี</td>
        <td width="22" align="center" valign="middle" class="th">ศ.</td>
        <td width="22" align="center" valign="middle" class="th">รศ.</td>
        <td width="22" align="center" valign="middle" class="th">ผศ.</td>
        <td width="22" align="center" valign="middle" class="th">อ.</td>
        <td width="22" height="32" align="center" valign="middle" class="th">เอก</td>
        <td width="22" align="center" valign="middle" class="th">โท</td>
        <td width="22" align="center" valign="middle" class="th">ตรี</td>
        <td width="22" align="center" valign="middle" class="th">ศ.</td>
        <td width="22" align="center" valign="middle" class="th">รศ.</td>
        <td width="22" align="center" valign="middle" class="th">ผศ.</td>
        <td width="22" align="center" valign="middle" class="th">อ.</td>
        <td width="22" height="32" align="center" valign="middle" class="th">เอก</td>
        <td width="22" align="center" valign="middle" class="th">โท</td>
        <td width="22" align="center" valign="middle" class="th">ตรี</td>
        <td width="22" align="center" valign="middle" class="th">ศ.</td>
        <td width="22" align="center" valign="middle" class="th">รศ.</td>
        <td width="22" align="center" valign="middle" class="th">ผศ.</td>
        <td width="22" align="center" valign="middle" class="th">อ.</td>
        <td width="22" height="32" align="center" valign="middle" class="th">เอก</td>
        <td width="22" align="center" valign="middle" class="th">โท</td>
        <td width="22" align="center" valign="middle" class="th">ตรี</td>
        <td width="22" align="center" valign="middle" class="th">ศ.</td>
        <td width="22" align="center" valign="middle" class="th">รศ.</td>
        <td width="22" align="center" valign="middle" class="th">ผศ.</td>
        <td width="22" align="center" valign="middle" class="th">อ.</td>
        <td width="22" height="32" align="center" valign="middle" class="th">เอก</td>
        <td width="22" align="center" valign="middle" class="th">โท</td>
        <td width="22" align="center" valign="middle" class="th">ตรี</td>
        <td width="22" align="center" valign="middle" class="th">ศ.</td>
        <td width="22" align="center" valign="middle" class="th">รศ.</td>
        <td width="22" align="center" valign="middle" class="th">ผศ.</td>
        <td width="22" align="center" valign="middle" class="th">อ.</td>
      </tr>


      <?
      $sql_dep = "SELECT * FROM  " . TB_REF_DEPARTMENT . "  ORDER BY NAME_FACULTY ASC ";
      $stid_dep = oci_parse($conn, $sql_dep);
      oci_execute($stid_dep);

      while ($row_dep = oci_fetch_array($stid_dep, OCI_BOTH)) {
        ?>
        <tr  >
          <td style="height:30px" align="right" valign="bottom" class="fac"><?= $row_dep['NAME_FACULTY'] ?></td>
          <td align="center" valign="bottom" class="fac fac3"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '', 'all') ?>')" ><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '', 'all'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '01') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '02') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '03') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '04') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '', '04') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '', '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '', '03') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '', '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '', '02') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '', '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '', '01') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '', '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('1', $row_dep['CODE_FACULTY'], '', '01,02,03,04') ?>')"><?= re_hyphen(count_person(views('1', $row_dep['CODE_FACULTY'], '', '01,02,03,04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '01') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '02') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '03') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '04') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '', '04') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '', '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '', '03') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '', '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '', '02') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '', '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '', '01') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '', '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('3', $row_dep['CODE_FACULTY'], '', '01,02,03,04') ?>')"><?= re_hyphen(count_person(views('3', $row_dep['CODE_FACULTY'], '', '01,02,03,04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '01') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '02') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '03') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '04') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '', '04') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '', '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '', '03') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '', '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '', '02') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '', '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '', '01') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '', '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('2', $row_dep['CODE_FACULTY'], '', '01,02,03,04') ?>')"><?= re_hyphen(count_person(views('2', $row_dep['CODE_FACULTY'], '', '01,02,03,04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '01') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '02') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '03') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '04') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '', '04') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '', '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '', '03') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '', '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '', '02') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '', '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '', '01') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '', '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('5', $row_dep['CODE_FACULTY'], '', '01,02,03,04') ?>')"><?= re_hyphen(count_person(views('5', $row_dep['CODE_FACULTY'], '', '01,02,03,04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '01') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '02') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '03') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data2"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '04') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '04') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '04'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '03') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '03'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '02') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '02'))) ?></a></td>
          <td align="center" valign="bottom" class="data"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '01') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '01'))) ?></a></td>
          <td align="center" valign="bottom" class="data22"><a style="cursor:pointer" onclick="openModal('<?= views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '01,02,03,04') ?>')"><?= re_hyphen(count_person(views('1,2,3,5', $row_dep['CODE_FACULTY'], '', '01,02,03,04'))) ?></a></td>
        </tr>
      <? } ?>
      <tr>
        <td style="height:30px" align="right" valign="bottom" class="fac2">รวม</td>
        <td align="center" valign="bottom" class="fac2  fac3"><?= re_hyphen(count_person(views('1,2,3,5', '', '', '', 'all'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('1', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1', '', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1', '', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1', '', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1', '', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('1', '', '', '01,02,03,04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('3', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('3', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('3', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('3', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('3', '', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('3', '', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('3', '', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('3', '', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('3', '', '', '01,02,03,04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('2', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('2', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('2', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('2', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('2', '', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('2', '', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('2', '', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('2', '', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('2', '', '', '01,02,03,04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('5', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('5', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('5', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('5', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('5', '', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('5', '', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('5', '', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('5', '', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('5', '', '', '01,02,03,04'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1,2,3,5', '', '01'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1,2,3,5', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222"><?= re_hyphen(count_person(views('1,2,3,5', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data3"><?= re_hyphen(count_person(views('1,2,3,5', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222" style="font-weight:bold"><?= re_hyphen(count_person(views('1,2,3,5', '', '', '04'))) ?></td>
        <td align="center" valign="bottom" class="data222" style="font-weight:bold"><?= re_hyphen(count_person(views('1,2,3,5', '', '', '03'))) ?></td>
        <td align="center" valign="bottom" class="data222" style="font-weight:bold"><?= re_hyphen(count_person(views('1,2,3,5', '', '', '02'))) ?></td>
        <td align="center" valign="bottom" class="data222" style="font-weight:bold"><?= re_hyphen(count_person(views('1,2,3,5', '', '', '01'))) ?></td>
        <td align="center" valign="bottom" style="font-weight:bold; padding-bottom:5px"><?= re_hyphen(count_person(views('1,2,3,5', '', '', '01,02,03,04'))) ?></td>
      </tr>
    </table><br />
    <div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'sdu_report_teacher_excel.php?excel=1'"/></div>
    <div id="dialog" title="รายชื่อบุคลากร"></div>
  </body>
</html>

<?

function views($emp_type = NULL, $mua_main = NULL, $degree = NULL, $mua_vpos = NULL, $where=NULL) {





  if ($mua_main != NULL) {
    $str.= "  CWK_MUA_MAIN = {$mua_main} ";
  }else
    $str.= "  CWK_MUA_MAIN != 0 ";

  if ($emp_type != NULL) {
    $str.=" AND CWK_MUA_EMP_TYPE IN ({$emp_type})";
  }




  if ($degree != NULL) {
    switch ($degree) {
      case '01':
        $str.=" AND DOCTER = 80";
        break;
      case '02':
        $str.=" AND (DOCTER <> 80  OR DOCTER is null) AND MASTE = 60";
        break;
      case '03':
        $str.=" AND (DOCTER <> 80  OR DOCTER is null) AND (MASTE <> 60  OR MASTE is null) AND  BACHELOR = 40  ";
        break;
      case '04':
        $str.=" AND (DOCTER = 80 OR MASTE = 60 OR BACHELOR = 40)";
        break;
    }
  }

  if ($mua_vpos != NULL) {
    $str.=" AND CWK_MUA_VPOS IN ({$mua_vpos})";
  }


  if ($where == 'all') {
    $str.="AND ((DOCTER = 80 OR MASTE = 60 OR BACHELOR = 40) OR  CWK_MUA_VPOS IN (01,02,03,04))";
  } elseif ($where != NULL) {
    $str.=" AND {$where}";
  }
  return $str;
}

function count_person($where) {

  global $conn;
  $sql = "SELECT count(*) as num FROM sdu_education_teacher WHERE  $where ";


  //echo $sql;
  $resource = oci_parse($conn, $sql);


  $result = oci_execute($resource);
  $row = oci_fetch_array($resource, OCI_BOTH);
  return $row['NUM'];
}

$db->closedb($conn);
?>