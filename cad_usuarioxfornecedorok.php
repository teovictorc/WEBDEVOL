<? include("inc/conn.inc.php"); 
	
	$ACESS = $_POST['ACESS'];
	$ID = $_POST['ID'];
	verifyAcess("CADVINCULOFORNECEDOR","S");
	
	$Stmt = mysql_query("DELETE FROM rar_usuarioxfornecedor WHERE USUFOR_USUAR_IDO = '" .$ID. "'");

	if (trim($_POST['ACESS'])) {
		$Ids = explode(",",$ACESS);
		for($x = 0; $x < count($Ids); $x++) {
		    $Sql = "INSERT INTO rar_usuarioxfornecedor (USUFOR_IDO,USUFOR_USUAR_IDO,USUFOR_PESSOA) VALUES ('" . newIDO() .
			       "','" .$ID. "','" .$Ids[$x]. "')";
			$Stmt = mysql_query($Sql);
		}
	}
	header("Location: pesq_usuarioxfornecedor.php?USUAR_IDO=" . $ID);	
?>