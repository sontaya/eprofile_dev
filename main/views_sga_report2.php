<?
@session_start();
include("../includes/connect.php");

$fileName = "uoc_staff.csv";
$objWrite = fopen("uoc_staff.csv", "w");

$year = $_GET['year'];

if (!isset($_GET["page"])) { $page = 1; } else { $page = $_GET["page"]; }


$prev_page = $page - 1;
$next_page = $page + 1;
$per_page = 50;

$page_start = (($per_page * $page) + 1) - $per_page;
$page_end = $page_start + $per_page - 1;
$sql = "SELECT *
        FROM
        ( SELECT rownum rnum, a.*
        FROM sdu_uoc_staff a
        where rownum <= {$page_end} )
        where rnum >= {$page_start} ";

$allnum = $db->count_row('sdu_uoc_staff', '', $conn);

$stid = oci_parse($conn, $sql);
oci_execute($stid);

$num_pages = ceil($allnum / $per_page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>สรุปคนลาออก</title>

    <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="../js/tablePagination.js"></script>

    <style type="text/css">
      .viewTable th,.viewTable td {
        padding-left: 3px;
        padding-right: 3px;
        border: #cccccc 1px solid;
        font-size: 0.8em;
      }

      .rowColor{
        background-color: #edfaed;
      }

      #tablePagination {
        background-color: #E3FAE3;
        font-size: 0.8em;
        height: 20px;
        padding: 0 5px;
      }
      #tablePagination_paginater {
        margin-left: auto;
        margin-right: auto;
      }
      #tablePagination img {
        cursor: pointer;
        padding: 0 2px;
      }
      #tablePagination_perPage {
        float: left;
      }
      #tablePagination_paginater {
        float: right;
      }
    </style>

    <script type="text/javascript">
      $(document).ready(function(){
        //$('#table').tablePagination();
      });
    </script>
  </head>

  <body>

    <table width="1181" id="table" class="viewTable"  style="margin-top: 20px;font-family:Tahoma, Geneva, sans-serif;font-size:14px;border-collapse: collapse" align="center">
      <thead>
        <tr style="height: 30px" align="center" bgcolor="#CAE4FF">
          <th>YEAR</th>
          <th>UNIV_ID</th>
          <th>CITIZEN_ID</th>
          <th>PREFIX_NAME</th>
          <th>STF_FNAME</th>
          <th>STF_LNAME</th>
          <th>GENDER_ID</th>
          <th>BIRTHDAY</th>
          <th>HOMEADD</th>
          <th>MOO</th>
          <th>STREET</th>
          <th>DISTRICT</th>
          <th>AMPHUR</th>
          <th>PROVINCE_ID</th>
          <th>TELEPHONE</th>
          <th>ZIPCODE</th>
          <th>NATION_ID</th>
          <th>STAFFTYPE_ID</th>
          <th>TIME_CONTACT_ID</th>
          <th>BUDGET_ID</th>
          <th>SUBSTAFFTYPE_ID</th>
          <th>ADMIN_POSITION_ID</th>
          <th>POSITION_ID</th>
          <th>POSITION_WORK</th>
          <th>DEPARTMENT_ID</th>
          <th>DATE_INWORK</th>
          <th>STAFF_LEV_ID</th>
          <th>SPECIAL_NAME</th>
          <th>TEACH_ISCED_ID</th>
          <th>GRAD_LEV_ID</th>
          <th style="width:200px">GRAD_CURR</th>
          <th>GRAD_ISCED_ID</th>
          <th>GRAD_PROG_ID</th>
          <th style="width:200px">GRAD_UNIV</th>
          <th>GRAD_COUNTRY_ID</th>
        </tr>
      </thead>
      <tbody>
        <?
        $n = 1;
        while ($row = oci_fetch_array($stid, OCI_BOTH)) {
          ?>      
          <tr <? if ($n % 2 == 0) { echo "class='rowColor'"; } ?>>
            <td><?= $year ?></td>
            <td>16500</td>
            <td><?= $row['CITIZEN_ID'] ?></td>
            <td align="center"><?= $row['PREFIX_NAME'] ?></td>
            <td><?= $row['STF_FNAME'] ?></td>
            <td><?= $row['STF_LNAME'] ?></td>
            <td align="center"><?= $row['GENDER_ID'] ?></td>
            <td align="center"><?= $row['BIRTHDAY'] ?></td>
            <td><?= $row['HOMEADD'] ?></td>
            <td><?= $row['MOO'] ?></td>
            <td><?= $row['STREET'] ?></td>
            <td><?= $row['DISTRICT'] ?></td>
            <td><?= $row['AMPHUR'] ?></td>
            <td><?= $row['PROVINCE_ID'] ?></td>
            <td><?= $row['TELEPHONE'] ?></td>
            <td align="center"><?= $row['ZIPCODE'] ?></td>
            <td align="center"><?= $row['NATION_ID'] ?></td>
            <td align="center"><?= $row['STAFFTYPE_ID'] ?></td>
            <td align="center"><?= $row['TIME_CONTACT_ID'] ?></td>
            <td align="center"><?= $row['BUDGET_ID'] ?></td>
            <td align="center"><?= $row['SUBSTAFFTYPE_ID'] ?></td>
            <td align="center"><?= $row['ADMIN_POSITION_ID'] ?></td>
            <td align="center"><?= $row['POSITION_ID'] ?></td>
            <td><?= $row['POSITION_WORK'] ?></td>
            <td align="center"><?= $row['DEPARTMENT_ID'] ?></td>
            <td align="center"><?= $row['DATE_INWORK'] ?></td>
            <td align="center"><?= $row['STAFF_LEV_ID'] ?></td>
            <td><?= $row['SPECIAL_NAME'] ?></td>
            <td align="center"><?= $row['TEACH_ISCED_ID'] ?></td>
            <td align="center"><?= $row['GRAD_LEV_ID'] ?></td>
            <td style="width:200px"><?= $row['GRAD_CURR'] ?></td>
            <td align="center"><?= $row['GRAD_ISCED_ID'] ?></td>
            <td align="center"><?= $row['GRAD_PROG_ID'] ?></td>
            <td style="width:200px"><?= $row['GRAD_UNIV'] ?></td>
            <td align="center"><?= $row['GRAD_COUNTRY_ID'] ?></td>
          </tr>
          <?
          $n++;
        }

//       /$objWrite = mb_convert_encoding($fileName, "UTF-16LE", "UTF-8");
        ?>
      </tbody>
    </table>
    <br />
    <div style="width:500px;font-size: 0.8em" id="pagination">
      <?
      $nfor = 0;
      for ($i = 1; $i <= $num_pages; $i++) {

        if ($num2 == 0 and $page == 1 and $i == 1) {

          echo "&nbsp;<u>$i</u>&nbsp;";
        } else if ($i <> $page) {
          echo "&nbsp;<a href='views_sga_report.php?page=$i&num=$nfor&year=$year' >$i</a>&nbsp;";
        } else {
          echo "&nbsp;<u style='padding:0px 6px 0px 6px;border:1px solid;background-color: #f9fbdb'>$i</u>&nbsp;";
        }
        $nfor = $nfor + $per_page;
      }///for
      ?>
    </div>
    <br />
    <?
    //สร้างไฟล์ csv
    $sql = "SELECT * FROM sdu_uoc_staff ";
    //print $sql;
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);
    while ($row = oci_fetch_array($stid, OCI_BOTH)) {
      // สร้างไฟล์ csv
      fwrite($objWrite, "'{$year}',");
      fwrite($objWrite, "16500");
      fwrite($objWrite, "'{$row['CITIZEN_ID']}',");
      fwrite($objWrite, "'{$row['PREFIX_NAME']}',");
      fwrite($objWrite, "'{$row['STF_FNAME']}',");
      fwrite($objWrite, "'{$row['GENDER_ID']}',");
      fwrite($objWrite, "'{$row['BIRTHDAY']}',");
      fwrite($objWrite, "'{$row['HOMEADD']}',");
      fwrite($objWrite, "'{$row['MOO']}',");
      fwrite($objWrite, "'{$row['STREET']}',");
      fwrite($objWrite, "'{$row['DISTRICT']}',");
      fwrite($objWrite, "'{$row['AMPHUR']}',");
      fwrite($objWrite, "'{$row['PROVINCE_ID']}',");
      fwrite($objWrite, "'{$row['TELEPHONE']}',");
      fwrite($objWrite, "'{$row['ZIPCODE']}',");
      fwrite($objWrite, "'{$row['NATION_ID']}',");
      fwrite($objWrite, "'{$row['STAFFTYPE_ID']}',");
      fwrite($objWrite, "'{$row['TIME_CONTACT_ID']}',");
      fwrite($objWrite, "'{$row['BUDGET_ID']}',");
      fwrite($objWrite, "'{$row['SUBSTAFFTYPE_ID']}',");
      fwrite($objWrite, "'{$row['ADMIN_POSITION_ID']}',");
      fwrite($objWrite, "'{$row['POSITION_ID']}',");
      fwrite($objWrite, "'{$row['POSITION_WORK']}',");
      fwrite($objWrite, "'{$row['DEPARTMENT_ID']}',");
      fwrite($objWrite, "'{$row['DATE_INWORK']}',");
      fwrite($objWrite, "'{$row['STAFF_LEV_ID']}',");
      fwrite($objWrite, "'{$row['SPECIAL_NAME']}',");
      fwrite($objWrite, "'{$row['TEACH_ISCED_ID']}',");
      fwrite($objWrite, "'{$row['GRAD_LEV_ID']}',");
      fwrite($objWrite, "'{$row['GRAD_CURR']}',");
      fwrite($objWrite, "'{$row['GRAD_ISCED_ID']}',");
      fwrite($objWrite, "'{$row['GRAD_PROG_ID']}',");
      fwrite($objWrite, "'{$row['GRAD_UNIV']}',");
      fwrite($objWrite, "'{$row['GRAD_COUNTRY_ID']}'");
      fwrite($objWrite, "\r\n");
    }
    fclose($objWrite);
    ?>
    <div align="center"><a href="views_sga_download.php">Export Csv</a> </div>
  </body>
</html>
<?
$db->closedb($conn);
?>