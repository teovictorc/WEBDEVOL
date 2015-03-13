<? include("inc/conn.inc.php"); 
	
	$ACESS = $_POST['ACESS'];
	$ID = $_POST['ID'];
	verifyAcess("CADVINCULOCLIENTE","S");
	
	$Stmt = mysql_query("DELETE FROM rar_usuarioxcliente WHERE USUCLI_USUAR_IDO = '" .$ID. "'");

	if (trim($_POST['ACESS'])) {
		$Ids = explode(",",$ACESS);
		for($x = 0; $x < count($Ids); $x++) {
		    $Sql = "INSERT INTO rar_usuarioxcliente (USUCLI_IDO,USUCLI_USUAR_IDO,USUCLI_PESSOA) VALUES ('" . newIDO() .
			       "','" .$ID. "','" .$Ids[$x]. "')";
			$Stmt = mysql_query($Sql);
		}
	}
	header("Location: pesq_usuarioxcliente.php?USUAR_IDO=" . $ID);	
?>