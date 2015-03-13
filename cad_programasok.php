<? include("inc/conn.inc.php"); 
	verifyAcess("CONFIG_PROGRAMAS","S");
	$ID = $_POST["ID"];
	$PROG_CODIGO = modifyData($_POST["PROG_CODIGO"]);
	$PROG_DESCRICAO = modifyData($_POST["PROG_DESCRICAO"]);
	$PROG_TIPO = modifyData($_POST["PROG_TIPO"]);
	
	
	$Stmt = mysql_query("SELECT * FROM RAR_PROGRAMA WHERE PROGR_CODIGO = '" .$PROG_CODIGO. "' " . ((trim($ID)) ? "AND PROGR_CODIGO <> '" .$ID. "'" : ""));
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		header("Location: cad_programas.php?ID=" .urlencode($ID).
			"&PROG_CODIGO=" .urlencode($PROG_CODIGO).
			"&PROG_DESCRICAO=" .urlencode($PROG_DESCRICAO).
			"&PROG_TIPO=" .urlencode($PROG_TIPO));
	}

	if (!trim($_POST["ID"])) {
		$Sql = "INSERT INTO RAR_PROGRAMA (" .
			   "PROGR_CODIGO,PROGR_DESCRICAO, " .
			   "PROGR_TIPO) VALUES ('" .
			   $PROG_CODIGO. "', '" .$PROG_DESCRICAO. "', '" .
			   $PROG_TIPO. "')";
	}else{
		$Sql = "UPDATE RAR_PROGRAMA SET " .
			   "PROGR_DESCRICAO = '" .$PROG_DESCRICAO. "' ".
			   ",PROGR_TIPO = '" .$PROG_TIPO. "' ".
			   ",PROGR_CODIGO = '" .$PROG_CODIGO. "' WHERE PROGR_CODIGO = '" .$ID. "'";
	}
	
	$Stmt = mysql_query($Sql);
	header("Location: pesq_programas.php");	
?>