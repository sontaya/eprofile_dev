<? 
		include("config.inc.php");

		$fac = $_POST["fac"];

			$sql = "SELECT * FROM SDU_REF_DEPARTMENT_SUB WHERE CODE_FACULTY = '$fac'";
			$stdt = oci_parse($conn,$sql);
			oci_execute($stdt);
			while(($row = oci_fetch_assoc($stdt)) != false) {
				$rows[] = $row;
			}

		header("Content-Type: application/json");
		echo json_encode($rows);

		oci_free_statement($stdt);
		oci_close($conn);     
?>