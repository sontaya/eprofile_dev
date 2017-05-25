<? 
  //include("lib/check_session.inc.php");
  include("lib/config.inc.php");
  include("lib/function.inc.php");
  include("lib/db.inc.php");
	
	$p = $_REQUEST["p"];
	$s = $_REQUEST["s"];
	$z = $_REQUEST["z"];
	$d = $_REQUEST["d"];
	
	
	$OPTIONAL_VAR = "Search=Y&z=".$z."&p=".$p."&d=".$d."&s=".$s;
	
	if($_REQUEST["Search"] == "Y"){
	
		if($z == "00" or $z == ""){
			$zoneCon = "";	
		}else{
			$zoneCon = " and zone_id = '$z'";	
		}
		
		if($p == "00" or $p == ""){
			$provCon = "";	
		}else{
			$provCon = " and province_id = '$p'";	
		}
		
		if($d == "00" or $d == ""){
			$provDis = "";	
		}else{
			$provDis = " and id_dis = '$d'";	
		}
		
		if($s != ""){
			$sCon = " and (tambon_name like '%".$s."%' or district_name like '%".$s."%' or province_name like '%".$s."%')";	
		}else{
			$sCon = "";	
		}
		
    
		$sql="	SELECT * 
						FROM $VIEW_LOCATION_ALL 
						WHERE 1=1 $zoneCon $provCon $provDis $sCon
						";	
		$res = $conn->query($sql);
		$num_result = $res->num_rows;
	} //-- end if search=y
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DUSITPOLL : VIEW TAP</title>

  <? include("css.inc.php") ?>

  <!-- DataTables CSS -->
  <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper"> 

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <? include("header.inc.php") ?>
            <? include("side.inc.php") ?>
        </nav>

        <div id="page-wrapper">
 
          <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"></h3>
              </div>
              <div class="panel-body">
                <div class="row-fluid">
                  <div class="col-md-6">
                    <form action="" method="POST" role="form" class="form-horizontal">

                      <div class="form-group">
                          <label class="col-md-2 control-label">ภูมิภาค</label>
                          <div class="col-md-10">
                            <select name="z" id="obj-zone" class="form-control">
                            </select> 
                          </div> 
                      </div>

                      <div class="form-group">
                        <label class="col-md-2 control-label">จังหวัด</label>
                        <div class="col-md-10">
                            <select name="p" id="obj-province" class="form-control">
                            </select> 
                        </div>
                      </div> 
                      
                      <div class="form-group">   
                        <label class="col-md-2 control-label">อำเภอ</label> 
                        <div class="col-md-10">
                          <select name="d" id="obj-district" class="form-control">
                          </select>                   
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="s" class="col-md-2 control-label">คำค้น</label>
                        <div class="col-md-10">
                          <input type="text" name="s" id="s" class="form-control" value="<?= $s ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-offset-2">
                          <button type="button" class="btn btn-primary" name="btnSearch" id="btnSearch">ค้นหาข้อมูล</button>
                          <input type="hidden" name="hid_search" id="hid_search" value="<?= $_REQUEST["Search"] ?>">
                          <input type="hidden" name="hid_z" id="hid_z" value="<?= $z ?>">
                          <input type="hidden" name="hid_p" id="hid_p" value="<?= $p ?>">
                          <input type="hidden" name="hid_d" id="hid_d" value="<?= $d ?>">
                        </div>
                      </div>

                    </form>
                  </div>
                  <div class="col-md-6"></div>
                  
                </div> 
                <!-- /.row-fluid -->
                
              </div>
              <!-- /.panel-body --> 
          </div>
          <!-- /.panel -->


          <? 
            if($_REQUEST["Search"] == "Y"){
          ?>
            <div class="panel panel-primary" id="search-result-box">
                <!-- Default panel contents -->
                <div class="panel-heading"></div>
                  <div class="panel-body">
                   
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="resultTable">
                        <thead>
                          <tr >

                            <th class="text-center" width="10%">ภาค</th>
                            <th class="text-center" width="10%">รหัสจังหวัด</th>
                            <th class="text-center" width="20%">ชื่อจังหวัด</th>
                            <th class="text-center" width="10%">รหัสอำเภอ</th>
                            <th class="text-center" width="20%">ชื่ออำเภอ</th>
                            <th class="text-center" width="10%">รหัสตำบล</th>
                            <th class="text-center" width="20%">ชื่อตำบล</th>
                          </tr>
                        </thead>
                        <tbody>
                        <? 
                          while($arr = $res->fetch_assoc()){
                        ?>    
                            <tr >
                              <td align="center" valign="middle">
                                <?= $arr["zone_name"]; ?></td>
                              <td align="center"><?= $arr["province_id"]; ?></td>                    
                              <td valign="middle"><?= $arr["province_name"]; ?></td>
                              <td align="center" valign="middle"><?= $arr["district_id"]; ?></td>
                              <td align="left" valign="middle"><?= $arr["district_name"]; ?></td>
                              <td align="center" valign="middle"><?= $arr["tambon_id"]; ?></td>
                              <td align="left"><?= $arr["tambon_name"]; ?></td>
                            </tr>
                        <? } ?>
                        </tbody>
                      </table>                        
                    </div>
                    <!-- /.table-responsive -->

                        
                  </div>
            </div>
            <!-- /#search-result-box -->

          <? } ?>

        </div>    
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper -->

    <? include("js.inc.php") ?>
    


    <script language="javascript">
    $(document).ready(function(){
      
      $("#resultTable").dataTable({
        language :{
            url : 'js/dataTable-TH.json'
        }
      });
      
      //--- initPage ---
      if($("#hid_search").val() == "Y"){
        initZone('obj-zone',$("#hid_z").val());
        initProvince('obj-province',$("#hid_p").val(),$("#hid_z").val());
        initDistrict('obj-district',$("#hid_d").val(),$("#hid_p").val());
      

      }else{
        initZone('obj-zone','');
        $("#obj-province").empty();
      }


      
      $("#obj-zone").change(function() {
        var zone_value = $(this).val();
        initProvince('obj-province', '', zone_value);
      });

      $("#obj-province").change(function() {
        var province_value = $(this).val();
        initDistrict('obj-district', '', province_value);
      });
     

      $("#btnSearch").click(function() {
        search_it();
      });



      
      function search_it(){
        var z = $("#obj-zone").val();
        var p = $("#obj-province").val();
        var d = $("#obj-district").val();
        var s = $("#s").val();
              
        if(z == "00"){
          window.location.href = "<?= $CONFIG_ROOT_URL ?>view-tap.php?Search=Y&z="+z;
        }else{
          window.location.href = "<?= $CONFIG_ROOT_URL ?>view-tap.php?Search=Y&z="+z+"&p="+p+"&d="+d+"&s="+s;
        }
        
      }

    }); //-- ./end ready(function)




    </script>

</body>
</html>
