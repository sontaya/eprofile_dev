<?
session_start();
if($_POST["pass"]=="Am3mBz3"){
		$_SESSION["login"]="Am3mBz3";
		print "<script>
			window.location='index.php';
		</script>";
}
else{
	print "<script>
	 		alert('PASSWORD ERROR');
			window.location='index.php';
		</script>";
}

?>