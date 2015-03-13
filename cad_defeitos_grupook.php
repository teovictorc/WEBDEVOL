<? include("inc/conn.inc.php"); 
	verifyAcess("CADDEFEITO","S");
	$ID = $_POST["ID"];
	$DEFEI_DESCRICAO = modifyData($_POST["DEFEI_DESCRICAO"]);
	$DEFEIG_CATEGORIA = modifyData($_POST["DEFEIG_CATEGORIA"]);
	
	if (!trim($_POST["ID"])) {
		$ID = newIDO();
		$Sql = "INSERT INTO rar_defeito_grupo (" .
			   "DEFEIG_IDO,DEFEIG_DESCRICAO, DEFEIG_CATEGORIA) VALUES ('" .
			   $ID. "', '" .$DEFEI_DESCRICAO. "','".$DEFEIG_CATEGORIA."')";
	}else{
		$Sql = "UPDATE rar_defeito_grupo SET " .
			   " DEFEIG_DESCRICAO = '" .$DEFEI_DESCRICAO. "', ".
			   " DEFEIG_CATEGORIA = '" .$DEFEIG_CATEGORIA. "' ".
			   " WHERE DEFEIG_IDO = '" .$ID. "'";
	}
	
	$Stmt = mysql_query($Sql);
	header("Location: pesq_defeitos_grupo.php");	
?>