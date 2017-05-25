<style type="text/css">
    <!--

    *{
        font-family: thsarabun;
    }

-->
</style>
<page style="font-size: 14pt" backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <div>
        <table  border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td rowspan="3" style="width: 40px"><img src="http://education.dusit.ac.th/logo/sdu-thai.jpg" style="width: 75px"><br/></td>
                    <td style="width: 500px;text-align: center"><span style="font-weight: bold; font-size: 15pt">มหาวิทยาลัยสวนดสิต</span></td>
                </tr>
                <tr>
                    <td style="text-align: center"><span style="font-weight: bold; font-size: 15pt;">ผลการเรียน</span></td>
                </tr>
        </tbody>
      </table>
      <table  border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 70px;text-align: right"><span>ชื่อ :</span></td>
                    <td style="width: 200px;text-align: left"><span><?php echo $std->PREFIX_NAME_TH.$std->FIRST_NAME_TH. ' ' . $std->LAST_NAME_TH ?></span></td>
                    <td style="width: 40px;text-align: right"><span>สาขา :</span></td>
                    <td style="width: 400px;text-align: left"><span><?php echo $std->MAJOR_NAME_TH ?></span></td>
                </tr>
                <tr>
                    <td style="text-align: right"><span>เกรดเฉลี่ย :</span></td>
                    <td><span><?php echo $std->GRAD_GPA ?></span></td>
                    <td style="text-align: right"><span>สถานะ :</span></td>
                    <td><span><?php echo $std->STD_STATUS_NAME_TH ?></span></td>
                </tr>
        </tbody>
    </table>
    <br/>
    <table  border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td style="width: 70px;text-align: center">รหัสวิชา</td>
                <td style="width: 250px;text-align: center">ชื่อวิชา</td>
                <td style="width: 50px;text-align: center">หน่วยกิต</td>
                <td style="width: 20px;text-align: center">เกรด</td>
                <td style="width: 20px;text-align: center">Cr</td>
                <td style="width: 50px;text-align: center">GP</td>
                <td style="width: 50px;text-align: center">CAX</td>
                <td style="width: 50px;text-align: center">CGX</td>
            </tr>
            <?php foreach($rs as $key=>$r) { ?>
             <tr>
              <td style="width: 70px;text-align: center"><span><?php echo $r->COURSE_CODE_SHOW ?></span></td>
              <td><?php echo $r->SUB_NAME_TH ?></td>
              <td style="text-align: center"><?php echo $r->CREDIT ?></td>
              <td style="text-align: center"><?php echo $r->GRADE ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <br/><br/><br/>
    <div>
        <span style="font-size: 10pt;"><?php echo date("d/m/Y - H:i") ?></span><br>
    </div>

</div>






</page>
