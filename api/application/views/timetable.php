<style type="text/css">
    <!--

    *{
        font-family: thsarabun;
    }


    .center {
        margin: auto;
        text-align: center;
        padding: 10px;
    }
    .right {
        margin: auto;
        text-align: right;
        padding: 10px;
    }


-->
</style>
<page style="font-size: 14pt" backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <div class="right">
        <span style="font-size: 10pt;"></span>
    </div>
    <div class="center">
        <table  border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td rowspan="3" style="width: 40px"><img src="http://education.dusit.ac.th/logo/sdu-thai.jpg" style="width: 75px"><br/></td>
                    <td style="width: 500px"><span style="font-weight: bold; font-size: 15pt;">มหาวิทยาลัยสวนดสิต</span></td>
                </tr>
                <tr>
                    <td><span style="font-weight: bold; font-size: 15pt;">รายงานแสดงรายชื่อนักศึกษาที่ลงทะเบียน</span></td>
                </tr>
                <tr>
                    <td><span style="font-weight: bold; font-size: 15pt;">ภาคการศึกษาที่ <?php echo $sub->SEMESTER . '/' . $sub->ACADEMIC_YEAR ?></span></td>
                </tr>

        </tbody>
      </table>
      <table  border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 20px;text-align: right"><span>คณะ:</span></td>
                    <td style="width: 200px;text-align: left"><span></span></td>
                    <td style="width: 20px;text-align: right"><span>สาขา:</span></td>
                    <td style="width: 60px;text-align: left"><span></span></td>
                </tr>
                <tr>
                    <td style="text-align: right"><span>ประเภทนักศึกษา:</span></td>
                    <td style="text-align: left"><span></span></td>
                    <td style="text-align: right"><span>สถานที่จัดการเรียนการสอน:</span></td>
                    <td style="text-align: left"><span><?php echo $sub->BUILDING_NAME ?> <?php echo $sub->SPLACE_NAME_TH ?></span></td>
                </tr>
                <tr>
                    <td style="text-align: right"><span>รหัสวิชา:</span></td>
                    <td style="text-align: left"><span><?php echo $sub->SUB_SHOW ?></span></td>
                    <td style="text-align: right"><span>ตอนเรียน:</span></td>
                    <td style="text-align: left"><span><?php echo $sub->SECTION_CODE ?></span></td>
                </tr>
                <tr>
                    <td style="text-align: right"></td>
                    <td style="text-align: left"><span><?php echo $sub->SUB_NAME_TH ?></span></td>
                    <td style="text-align: right"></td>
                    <td style="text-align: left"></td>
                </tr>

        </tbody>
    </table>

    <table  border="1" cellpadding="1" cellspacing="0">
        <tbody>
            <tr>
                <td rowspan="2" style="width: 25px;text-align: center">ลำดับ</td>
                <td rowspan="2" style="width: 100px;text-align: center">รหัสนักศึกษา</td>
                <td rowspan="2" style="width: 150px;text-align: center">ชื่อ - นามสกุล</td>
                <td colspan="13" style="width: 210px;text-align: center">คะแนนเก็บ</td>
                <td rowspan="2" style="width: 25px;text-align: center">รวม</td>
                <td rowspan="2" style="width: 20px;text-align: center">Mid</td>
                <td rowspan="2" style="width: 25px;text-align: center">Fin</td>
                <td rowspan="2" style="width: 25px;text-align: center">Total</td>
                <td rowspan="2" style="width: 27px;text-align: center">Grade</td>
            </tr>
            <tr>
              <td style="text-align: center">1</td>
              <td style="text-align: center">2</td>
              <td style="text-align: center">3</td>
              <td style="text-align: center">4</td>
              <td style="text-align: center">5</td>
              <td style="text-align: center">6</td>
              <td style="text-align: center">7</td>
              <td style="text-align: center">8</td>
              <td style="text-align: center">9</td>
              <td style="text-align: center">10</td>
              <td style="text-align: center">11</td>
              <td style="text-align: center">12</td>
              <td style="text-align: center">13</td>
            </tr>
                <?php foreach($std as $key=>$s) { ?>
            <tr>
              <td><?php echo $key +1 ?></td>
              <td><?php echo $s->STD_CODE ?></td>
              <td style="text-align:left"><?php echo $s->PREFIX_NAME_TH.$s->STUDENT_FIRSTNAME . ' ' . $s->STUDENT_LASTNAME ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
  <div class="right">
      <span style="font-size: 10pt;"><?php echo date("d/m/Y - H:i") ?></span><br>

  </div>
</div>





</page>
