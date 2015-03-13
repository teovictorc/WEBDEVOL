<? include("inc/conn.inc.php"); 
	verifyAcess("CADDEFEITO","S");
	$ID = $_POST["ID"];
	$DEFEIS_DESCRICAO = modifyData($_POST["DEFEI_DESCRICAO"]);
	$DEFEIS_DEFEIG_IDO = modifyData($_POST["DEFEIS_DEFEIG_IDO"]);
	
	if (!trim($_POST["ID"])) {
		$ID = newIDO();
		$Sql = "INSERT INTO rar_defeito_subgrupo (" .
			   "DEFEIS_IDO,DEFEIS_DESCRICAO, DEFEIS_DEFEIG_IDO) VALUES ('" .
			   $ID. "', '" .$DEFEIS_DESCRICAO. "','" .$DEFEIS_DEFEIG_IDO. "')";
	}else{
		$Sql = "UPDATE rar_defeito_subgrupo SET " .
			   "DEFEIS_DESCRICAO = '" .$DEFEIS_DESCRICAO. "', ".
			   "DEFEIS_DEFEIG_IDO = '" .$DEFEIS_DEFEIG_IDO. "' ".
			   " WHERE DEFEIS_IDO = '" .$ID. "'";
	}
	
	$Stmt = mysql_query($Sql);
	header("Location: pesq_defeitos_subgrupo.php");	
?>