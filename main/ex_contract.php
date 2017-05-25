<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>

<? }

?>
<script language="javascript">

function new_contract(emp_id,b_contract_no){
	window.open("ex_new_contract.php?emp_id="+emp_id+"&b_contract_no="+b_contract_no,"new_contract","width=800,height=500");
}

</script>

<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->

<div  align="center" id="ex_contract_data">
<? include "ex_contract2.php";?>
</div>

<? $db->closedb($conn);	?>