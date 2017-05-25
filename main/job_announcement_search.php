<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
  ?>
  <script language="javascript">
    window.location = "../" ;
  </script>
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ระบบบริหารงานบุคลากร กองบริหารงานบุคคล มหาวิทยาลัยราชภัฎสวนดุสิต</title>
    <link rel="stylesheet" type="text/css" href="../css/main1.css" />
    <link rel="stylesheet" type="text/css" href="../css/form.css" />
    <link rel="stylesheet" type="text/css" href="../css/menu.css" />
    <link rel="stylesheet" type="text/css" href="../jquery-ui-1.8.6.custom/css/smoothness/jquery-ui-1.8.6.custom.css"/>
    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../jquery-ui-1.8.6.custom/js/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../jquery-ui-1.8.6.custom/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
    <!--<script src="../js/menu-collapsed.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="../js/ddaccordion.js"></script>
    <script src="../js/autoComplete.js" type="text/javascript"></script>
    <script src="../js/myAjax.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
      function check()
      {
        if (window.top!=window.self)
        {
          alert("<p>This window is not the topmost window! Am I in a frame?</p>")
        }
        else
        {
          alert("<p>This window is the topmost window!</p>")
        }
      }
      function edit_job(rel){
        self.opener.document.getElementById("jnc_topic").value = $('div#jnc_topic'+rel).html();
        self.opener.document.getElementById("jnc_date").value = $('div#jnc_date'+rel).html();
        self.opener.document.getElementById("jnc_order_no").value = $('div#jnc_order_no'+rel).html();
        self.opener.document.getElementById("jnc_pos_name").value = $('div#jnc_pos_name'+rel).html();
        self.opener.document.getElementById("jnc_responsibility").value = $('div#jnc_responsibility'+rel).html();
        self.opener.document.getElementById("jnc_depart").value = $('div#jnc_depart'+rel).html();
        self.opener.document.getElementById("jnc_salary").value = $('div#jnc_salary'+rel).html();
        self.opener.document.getElementById("jnc_quantity").value = $('div#jnc_quantity'+rel).html();
        self.opener.document.getElementById("jnc_qualification").value = $('div#jnc_qualification'+rel).html();
        self.opener.document.getElementById("jnc_qualification_ps").value = $('div#jnc_qualification_ps'+rel).html();
        self.opener.document.getElementById("jnc_spec_qualification").value = $('div#jnc_spec_qualification'+rel).html();
        self.opener.document.getElementById("jnc_description").value = $('div#jnc_description'+rel).html();
        self.opener.document.getElementById("jnc_date_place").value = $('div#jnc_date_place'+rel).html();
        self.opener.document.getElementById("jnc_attach_file").value = $('div#jnc_attach_file'+rel).html();
        //self.opener.document.getElementById("jnc_status").value = $('div#jnc_status'+rel).html();
	
        if($('div#jnc_status'+rel).html() == "1"){
          self.opener.document.job_announcement.jnc_status[0].checked="checked";
        }else if($('div#jnc_status'+rel).html() == "2"){
          self.opener.document.job_announcement.jnc_status[1].checked="checked";
        }
	
        self.opener.document.getElementById("jnc_id").value = $('div#jnc_id'+rel).html();
        //window.blur();
            
        self.opener.window.focus();
        window.close();
      }
      function check_data(){
        document.getElementById("search_res").innerHTML = "";
        var myform = document.getElementById("job_announcement_search");
        /*if(myform.jnc_order_no.value == "" && myform.jnc_pos_name.value == "" && myform.jnc_description.value == "" && myform.jnc_depart.value == ""){
                alert("กรุณากรอกข้อมูลอย่างใดอย่างหนึ่ง");	
                return false;
          }*/
	
        var data = "";
        data += "jnc_order_no="+myform.jnc_order_no.value;
        data += "&jnc_pos_name="+myform.jnc_pos_name.value;
        data += "&jnc_topic="+myform.jnc_topic.value;
        data += "&jnc_description="+myform.jnc_description.value;
        data += "&jnc_depart="+myform.jnc_depart.value;
        if(myform.jnc_status[0].checked==true){
          var status = "1";
        }else{
          var status = "2";
        }
        data += "&jnc_status="+status;
        ajaxPostData("search_return_job.php",data,"text","search_res",result_search,"","");
      }

      function result_search(response){
        if(response == "0"){
          document.getElementById("search_res").innerHTML = "<div style='color:red;'><h2>- ไม่มีข้อมูล -</h2></div>";
        }else{
          document.getElementById("search_res").innerHTML = response;
        }
      }

      $(function() {
        $("#exp_expert1").autocomplete({
          source: expertTags
        });
	   
        $('#Save_success').dialog({
          resizable: false,
          autoOpen: false,
          modal: true,
          hide: 'slide',
          buttons: {
            ตกลง: function() {
              $(this).dialog('close');
            }
          }
        });
		
        $('#Save_error').dialog({
          resizable: false,
          autoOpen: false,
          modal: true,
          hide: 'slide',
          show: 'slide',
          buttons: {
            ตกลง: function() {
              $(this).dialog('close');
            }
          }
        });
		
      });
    </script>
  </head>
  <table cellpadding="0" cellspacing="0" align="center" width="934">
    <tr><td width="934" ><div align="center"><h2>ประวัติการรับสมัคร</h2></div>
        <table  cellspacing="0" cellpadding="0" align="center" >
          <tr>
            <td width="756" valign="top">
              <form id="job_announcement_search" name="job_announcement_search" method="post" >
                <table width="762" border="0" cellspacing="4" cellpadding="4">
                  <tr>
                    <td width="256" align="right" class="form_text">เรื่อง : </td>
                    <td width="478" align="left"><input type="text" name="jnc_topic" id="jnc_topic" style="width: 200px; " class="input_text"/></td>
                  </tr>
                  <tr>
                    <td width="256" align="right" class="form_text">เลขที่คำสั่ง : </td>
                    <td width="478" align="left"><input type="text" name="jnc_order_no" id="jnc_order_no" style="width: 200px; " class="input_text"/></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">ชื่อตำแหน่ง :</td>
                    <td align="left"><input type="text" name="jnc_pos_name" id="jnc_pos_name" style="width: 200px; " class="input_text" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">รายละเอียดการจ้างงาน :</td>
                    <td align="left">
                      <?
                      $fpath = '../';
                      require_once($fpath . "includes/connect.php");
                      $sql_emp_type = "SELECT * FROM  " . TB_REF_STAFFTYPE . "  ORDER BY STAFFTYPE_ID ASC ";
                      $stid_emp_type = oci_parse($conn, $sql_emp_type);
                      oci_execute($stid_emp_type);
                      $option_emp_type = "<option value=''>เลือก</option>";
                      while (($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))) {
                        $option_emp_type .= "<option value='" . $row_emp_type["STAFFTYPE_ID"] . "' >" . $row_emp_type["STAFFTYPE_NAME"] . "</option>\n";
                      }
                      ?>
                      <select name="jnc_description" id="jnc_description" class="widthFix" >
                        <?= $option_emp_type ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">สังกัด/หน่วยงาน :</td>
                    <td align="left"><input type="text" name="jnc_depart" id="jnc_depart" style="width: 300px; " class="input_text" /></td>
                  </tr>
                  <tr>
                    <td align="right" class="form_text">สถานะ :</td>
                    <td align="left"><input name="jnc_status" type="radio" id="jnc_status"  value="1" checked="checked"/> แสดง <input type="radio" name="jnc_status" id="jnc_status"  value="2"/> ซ่อน </td>
                  </tr>
                  <tr>
                    <td align="right" >&nbsp;</td>
                    <td align="left"><input type="button" value="&nbsp;&nbsp;ค้นหา&nbsp;&nbsp;" onClick="check_data()"/></td>
                  </tr>

                  <tr>
                    <td colspan="2" align="left"  valign="top" style="padding-left:10px; color:#06C;"></td>
                  </tr>
                </table>
              </form>
            </td>
          </tr>

        </table>
        <div id="search_res" align="center"></div>
      </td>
    </tr>  
  </table>
</body>
</html>