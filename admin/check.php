<? 
//	error_reporting(E_ALL);
	session_start();
	require_once("config.inc.php");


	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HR : SEARCH</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css"/>

    <!-- Include FontAwesome CSS if you want to use feedback icons provided by FontAwesome -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet"> 

    <link rel="stylesheet" type="text/css" href="css/reset.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
           <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
    <![endif]-->



</head>

<body>
  <div class="container">
  

    <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
              <div class="row-fluid">
                <div class="col-md-6">
                  <form action="" role="form" accept-charset="utf-8" class="form-horizontal">
                      <div class="form-group">
                          <label class="col-md-4 control-label">รหัส / ชื่อ / นามสกุล : </label>
                          <div class="col-md-8">
                            <input type="text" name="keyword" id="inputKeyword" class="form-control" value="" >
                          </div> 
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">ประเภทบุคลากร : </label>
                          <div class="col-md-8">
                              <select name="emp_type" id="emp_type" class="form-control">
                                      <option value="" >ทุกประเภท</option>
                                  <?php
                                    $sql = "SELECT STAFFTYPE_ID, STAFFTYPE_NAME ";
                                    $sql .= "FROM SDU_REF_STAFFTYPE";
                                    $stdt = oci_parse($conn,$sql);
                                    oci_execute($stdt);
                                    while($rc = oci_fetch_array($stdt)) {
                                  ?>
                                      <option value="<?php echo $rc['STAFFTYPE_ID']; ?>" ><?php echo $rc['STAFFTYPE_NAME']; ?></option>
                                  <?php
                                    }
                                  ?>
                              </select>                            
                          </div> 
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">สังกัดคณะ : </label>
                          <div class="col-md-8">
                            <select name="emp_faculty" id="emp_faculty" class="form-control" >
                            </select>
                          </div> 
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">สังกัดย่อย : </label>
                          <div class="col-md-8">
                            <select name="emp_department" id="emp_department" class="form-control" >
                            </select>
                          </div> 
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">สถานะบุคลากร : </label>
                          <div class="col-md-8">
                              <select name="staff_status" id="staff_status" class="form-control">
                                <option value="">ทุกประเภท</option>
                                  <?php
                                    $sql = "SELECT * FROM SDU_REF_STATUS_EXT";
                                    $ss = oci_parse($conn,$sql);
                                    oci_execute($ss);
                                    while($arr_ss = oci_fetch_array($ss)) {
                                  ?>
                                      <option value="<?php echo $arr_ss['STATUS_ID']; ?>" <? if($_POST["staff_status"] == $arr_ss['STATUS_ID']){echo "selected='selected'";} ?>><?php echo $arr_ss['STATUS_NAME']; ?></option>
                                  <?php
                                    }
                                  ?>
                              </select>                            
                          </div> 
                      </div>

                      <div class="form-group">
                        <div class="col-md-offset-3">
                          <button type="button" class="btn btn-primary" name="btnSearch" id="btnSearch">ค้นหาข้อมูล</button>    
                          <button type="button" class="btn btn-primary" name="btnClear" id="btnClear">Clear</button>
                          <input type="hidden" name="hid_search" id="hid_search" class="form-control" value="">
                        </div>
                      </div>
                    
                  </form>
                </div>
              </div>
            </div>
        </div>  
    </div>

<div id="debug"></div>

  </div>
  <!-- /.container -->


<div class="table-responsive">
  <div class="container">
  

    <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="resultTable">
      <thead>
        <tr>
              <th class="text-center">รหัส</th>
              <th class="text-center">ชื่อ-นามสกุล</th>
              <th class="text-center">Name Surname</th>
              <th class="text-center">สถานะ</th>
              <th class="text-center">ประเภทบุคลากร</th>
              <th class="text-center">สังกัดหลัก</th>
              <th class="text-center">สังกัดย่อย</th>
              <th class="text-center">สังกัดศูนย์</th>
              <th class="text-center">วันเกิด</th>
              <th class="text-center">วันเริ่มงาน</th>
              
              <th class="text-center">Mobile</th>
              <th class="text-center">P.Office</th>

              

        </tr>

      </thead>    
    
    </table>
  </div>
  <!-- /.container -->
</div>
<!-- /.table-responsive -->


    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript">

        

       $(document).ready(function(){
          
          $("#hid_search").val('<?= $_REQUEST["s"] ?>');
         
          initTableFromJson();

          if($("#hid_search").val() == "y"){
            var KeyDatas = localStorage.getItem('searchKey');
            var KeyData = JSON.parse(KeyDatas);
            $("#inputKeyword").val(KeyData["keyword"]);
            $("#emp_type").val(KeyData["emp_type"]);
            $("#emp_faculty").val(KeyData["emp_faculty"]);
            initFaculty('emp_faculty',KeyData["emp_faculty"]);
            initDepartment('emp_department',KeyData["emp_department"],KeyData["emp_faculty"]);
            
            $("#staff_status").val(KeyData["staff_status"]);
           
          }else{
            localStorage.removeItem('searchObject');
            localStorage.removeItem('searchKey');

            initFaculty('emp_faculty','');

            var table = $("#resultTable").DataTable();
            table.clear();
            table.draw();
          }
          
          $("#emp_faculty").change(function(){
            var fac_value = $(this).val();
            initDepartment('emp_department','',fac_value);
          });

          $("#btnSearch").click(function(){

            
              var formData = {
                'keyword' : $("#inputKeyword").val(), 
                'emp_type' : $("#emp_type").val() ,
                'emp_faculty' : $("#emp_faculty").val(),
                'emp_department' : $("#emp_department").val(),
                'staff_status' : $("#staff_status").val() 
              };

              var ReturnObj;

              $.ajax({
                url: 'json-search-result.php',
                type: 'post',
                data: formData,
                dataType : 'json',
                cache: false,
                success: function (ajaxResult) {
                  //localStorage.removeItem('searchObject');
                  localStorage.setItem('searchObject', JSON.stringify(ajaxResult));
                  localStorage.setItem('searchKey', JSON.stringify(formData));
                },
                complete: function(){
                  window.location.href = "check.php?s=y";  
                 
                }
              });
            
              
           });

          $("#btnClear").click(function(){
          
             localStorage.removeItem('searchObject');
             localStorage.removeItem('searchKey');
             window.location.href = "check.php";  
             return false;
          
            
          });

        }); 
        /*-- /$(document).ready() --*/

        function initFaculty(targetID, selectedValue){

          var objTarget = "#" + targetID;
          $.ajax({
              url: 'json-obj-faculty.php',
              type: 'post',
              data: "",
              dataType:'text',
              cache: false,
              success: function (ajaxResult) {
                var $obj = $(objTarget);
                $obj.empty();               
                $obj.append("<option value=''>แสดงทุกสังกัด</option>");
                
                $.each( $.parseJSON(ajaxResult), function( key, val ) {
                  $obj.append("<option value='"+ val.CODE_FACULTY +"'>" + "["+ val.CODE_FACULTY +"] - "+ val.NAME_FACULTY + "</option>"); 
                });

              },
              complete: function(){
                setSelectValue(targetID,selectedValue);
              }
          });
        }

        function initDepartment(targetID, selectedValue, fac){

          var objTarget = "#" + targetID;
          var formData = {
            'fac' : fac,
          };
          $.ajax({
              url: 'json-obj-department.php',
              type: 'post',
              data: formData,
              dataType:'text',
              cache: false,
              success: function (ajaxResult) {
                var $obj = $(objTarget);
                $obj.empty();               
                $obj.append("<option value=''>แสดงทุกสังกัด</option>");
                
                $.each( $.parseJSON(ajaxResult), function( key, val ) {
                  $obj.append("<option value='"+ val.CODE_DEPARTMENT_SECTION +"'>" + "["+ val.CODE_DEPARTMENT_SECTION +"] - "+ val.NAME_DEPARTMENT_SECTION + "</option>"); 
                });

              },
              complete: function(){
                setSelectValue(targetID,selectedValue);
              }
          });
        }    
        
        function setSelectValue(targetID, selectedValue){
        
          var objTarget = "#" + targetID;
          $(objTarget).val(selectedValue);
        
        }    


        function initTableFromJson(){
           var jSource = JSON.parse(localStorage.getItem('searchObject'));
            
            
              $("#resultTable").dataTable({
                  "bSort" : false,
                  "aaData" : jSource,
                  "aoColumns" : [
                    { "mDataProp": "CODE_PERSON"},
                    { "mDataProp": "FULLNAME_THA"},
                    { "mDataProp": "FULLNAME_ENG"},
                    { "mDataProp": "NAME_STATUS"},
                    { "mDataProp": "STAFF_TYPE_NAME"},
                    { "mDataProp": "NAME_FACULTY"},
                    { "mDataProp": "NAME_DEPARTMENT"},
                    { "mDataProp": "NAME_SITE"},
                    { "mDataProp": "BIRTH_DATE_THA"},
                    { "mDataProp": "START_WORK_DATE_THA"},
                    { "mDataProp": "MOBILE1"},
                    { "mDataProp": "PHONE_OFFICE"}
                  ],
                  "columnDefs": [
                    { "width": "8%", "targets": 0 },
                    { "width": "10%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "8%", "targets": 3 },
                    { "width": "15%", "targets": 4 },
                    { "width": "15%", "targets": 5 },
                    { "width": "15%", "targets": 6 },
                    { "width": "15%", "targets": 7 }
                  ], 
                  language :{
                    url : 'js/dataTable-TH.json'
                  }   
                });
           
                /*-- /#resultTable --*/
          }
    </script>

</body>
</html>