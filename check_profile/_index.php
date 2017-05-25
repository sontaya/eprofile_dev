<?
	include("../includes/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>ตรวจสอบความถูกต้องของข้อมูล</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">e-Profile</a>
        </div>
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h2>ขอความร่วมมือในการตรวจสอบข้อมูลส่วนบุคคล</h2>
        <p>ยินดีต้อนรับ <? $sql = "SELECT * FROM  " . TB_BIODATA_TAB . "  WHERE  EMP_ID = '" . $_SESSION["EMP_ID"] . "'";
$row = $db->fetch($sql, $conn); echo $row["BIO_FNAME_TH"]." ".$row["BIO_LNAME_TH"]." (".$row["EMP_ID"].")";
 ?> </p>
        <p><strong>คำชี้แจง</strong><br />
	        <ul>
            	<li>ระบบนี้จัดทำขึ้นเพื่อให้บุคลากรมหาวิทยาลัยสวนดุสิต ได้ทำการตรวจสอบข้อมูลส่วนบุคคล รวมถึงสามารถแก้ไข/ปรับปรุงข้อมูลของท่านให้เป็นข้อมูลที่ถูกต้องและเป็นปัจจุบัน เพื่อเป็นประโยชน์ในการนำข้อมูลไปใช้ในการดำเนินงานของมหาวิทยาลัยฯ ต่อไป</li>
            	<li>ข้อมูลที่ปรากฏในระบบนี้อ้างอิงมาจาก "ระบบบริหารงานบุคคล กองบริหารงานบุคคล มหาวิทยาลัยสวนดุสิต (e-Profile)"</li>
            	<li>ขอความร่วมมือบุคลากร ตรวจสอบข้อมูลส่วนบุคคลของท่านทำการตรวจสอบข้อมูลให้ครบทุกเมนู จึงจะสามารถเข้าสู่หน้าจอของระบบสำรองการที่นั่งการอบรมได้</li>
            </ul>
        </p>
      </div>
    </div>
<?
 $sql_check="SELECT * FROM SDU_CHECK_PROFILE WHERE EMP_ID = '" . $_SESSION["EMP_ID"] . "' ";
 $row_check = $db->fetch($sql_check, $conn); 
 $bt_true=0;
?>
    <div class="container">
      <!-- Example row of columns -->

        <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active <? if($row_check["PROFILE_STATUS"]){ echo "bg-success"; if($bt_true==2){ $bt_true=2; }else{ $bt_true=1; } }else{ $bt_true=2; } ?>" id="tab_profile"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">ข้อมูลเบื้องต้น</a></li>
        <li role="presentation" class=" <? if($row_check["ADDRESS_STATUS"]){ echo "bg-success"; if($bt_true==2){ $bt_true=2; }else{ $bt_true=1; } }else{ $bt_true=2; } ?>" id="tab_address"><a href="#address" aria-controls="address" role="tab" data-toggle="tab">ที่อยู่ตามทะเบียนบ้าน, ปัจจุบัน</a></li>
        <li role="presentation" class=" <? if($row_check["HISTORY_EDU_STATUS"]){ echo "bg-success"; if($bt_true==2){ $bt_true=2; }else{ $bt_true=1; } }else{ $bt_true=2; } ?>" id="tab_history_edu"><a href="#history_edu" aria-controls="history_edu" role="tab" data-toggle="tab">ประวัติการศึกษา</a></li>
        <li role="presentation" class=" <? if($row_check["CURRENT_POSITION_STATUS"]){ echo "bg-success"; if($bt_true==2){ $bt_true=2; }else{ $bt_true=1; } }else{ $bt_true=2; } ?>" id="tab_current_position"><a href="#current_position" aria-controls="current_position" role="tab" data-toggle="tab">ตำแหน่งปัจจุบัน</a></li>
        </ul>

        <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="profile">
			<? include("pages/profile.php"); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="address">
        	<? include("pages/address.php"); ?>
		</div>
        <div role="tabpanel" class="tab-pane" id="history_edu">
        	<? include("pages/history_edu.php"); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="current_position">
        	<? include("pages/current_position.php"); ?>
        </div>
        </div>

  <div class="row" style="text-align:center">
  	<?
    if($bt_true==1){
		?>
        <button id="bt_confirm" name="bt_confirm" class="btn-primary">ยืนยันข้อมูล</button>
		<?
	}
	?>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form id="CommentFrm" name="CommentFrm">
          <div class="form-group">
            <label for="personal-id" class="control-label">รหัสบุคลากร:</label>
            <input type="text" class="form-control" id="personal-id" value="<?=$_SESSION["EMP_ID"]?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">ส่วนที่ปรับแก้ไข:</label>
            <input type="text" class="form-control" id="recipient-name" value="<?=$_SESSION["EMP_ID"]?>">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <input class="btn btn-success" type="submit" value="Send!" id="submit">
      </div>
    </div>
  </div>
</div>

      <hr>

      <footer>
<!--        <p>&copy; Company 2014</p>-->
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
		$(function () {

		$('.collapse').collapse('hide')
		  
		$("#submit").click(function(){
			$.ajax({
				type: "POST",
				url: "pages/save.php",
				data: {
					personal_id : $('#personal-id').val(),
					page_name : $('#recipient-name').val(),
					comment_page : $('#message-text').val(),
					},
				success: function(msg){
					location.reload();
				},
				error: function(){
					alert("Error !!");
				}
				});
			});
		});

		$("#bt_confirm").click(function(){
			$.ajax({
				type: "POST",
				url: "pages/save_confirm.php",
				data: {
					personal_id : '<?=$_SESSION["EMP_ID"]?>',
					},
				success: function(msg){
					window.location='http://sduthelink.dusit.ac.th/etraining/update_eprofile.php?emp_id=<?=$_SESSION["EMP_ID"]?>';
				},
				error: function(){
					alert("Error !!");
				}
			});
		});
		

		$('#exampleModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('ข้อมูลที่ต้องแก้ไข ' + recipient)
		  modal.find('.modal-body #recipient-name').val(recipient)
		  modal.find('.modal-body #message-text').val('')
		})
		
		function check_radio(name_radio){
			if($("input[name=chk_"+name_radio+"]:checked").val()=='2'){
				$("#bt_"+name_radio+"").removeAttr('disabled');
			}else{
				$("#bt_"+name_radio+"").attr('disabled', 'disabled');
				$.ajax({
					type: "POST",
					url: "pages/save_true.php",
					data: {
						personal_id : '<?=$_SESSION["EMP_ID"]?>',
						page_name : name_radio,
						},
					success: function(msg){
					location.reload();
					},
					error: function(){
						alert("Error !!");
					}
				});
			}
		}

	</script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
