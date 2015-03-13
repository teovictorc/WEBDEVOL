<? include("inc/conn.inc.php"); 
	verifyAcess("CADDEFEITO","S");
	$ID = $_POST["ID"];
	$DEFEI_DESCRICAO = modifyData($_POST["DEFEI_DESCRICAO"]);
	
	if (!trim($_POST["ID"])) {
		$ID = newIDO();
		$Sql = "INSERT INTO rar_defeito (" .
			   "DEFEI_IDO,DEFEI_DESCRICAO) VALUES ('" .
			   $ID. "', '" .$DEFEI_DESCRICAO. "')";
	}else{
		$Sql = "UPDATE rar_defeito SET " .
			   "DEFEI_DESCRICAO = '" .$DEFEI_DESCRICAO. "' ".
			   " WHERE DEFEI_IDO = '" .$ID. "'";
	}
	
	$Stmt = mysql_query($Sql);
	header("Location: pesq_defeitos.php");	
?>