<? include("inc/conn.inc.php"); 
	verifyAcess("CADPDV_PERGUNTA","S");
	
	$ID = $_POST["ID"];
	$PERGU_PERGUNTA 					= modifyData($_POST["PERGU_PERGUNTA"]);
	$PERGU_LEGENDA 					= modifyData($_POST["PERGU_LEGENDA"]);
	$PERGU_ATIVO 				= modifyData($_POST["PERGU_ATIVO"]);

	
	if (!trim($_POST["ID"])) {
		$ID = newIDO();
		$Sql = "INSERT INTO RAR_PDV_PERGUNTA (";
		$Sql.= " PERGU_IDO, PERGU_PERGUNTA, PERGU_LEGENDA, PERGU_ATIVO ";
		$Sql.= " ) VALUES (";
		$Sql.= "'".$ID."', ";
		$Sql.= "'".$PERGU_PERGUNTA."', ";
		$Sql.= "'".$PERGU_LEGENDA."', ";
		$Sql.= "'".$PERGU_ATIVO."' ";
		$Sql.= ")";
	}else{
		$Sql = "UPDATE RAR_PDV_PERGUNTA SET ";
		$Sql.= " PERGU_PERGUNTA 				= '".$PERGU_PERGUNTA."',";
		$Sql.= " PERGU_LEGENDA 	= '".$PERGU_LEGENDA."',";
		$Sql.= " PERGU_ATIVO 			= '".$PERGU_ATIVO."'";
		$Sql.= " WHERE PERGU_IDO = '" .$ID. "'";
	}
	$Stmt = mysql_query($Sql);
	header("Location: pesq_pergunta.php");	
?>