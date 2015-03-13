<? include("inc/conn.inc.php"); 
	verifyAcess("CADDEFEITO","S");
	$ID = $_POST["ID"];
	$EQUIP_NOME = modifyData($_POST["EQUIP_NOME"]);
	
	if (!trim($_POST["ID"])) {
		$ID = newIDO();
		$Sql = "INSERT INTO RAR_EQUIPE (" .
			   "EQUIP_IDO,EQUIP_NOME, EQUIP_USUAR_IDO) VALUES ('" .
			   $ID. "', '" .$EQUIP_NOME. "', '" .$EQUIP_USUAR_IDO. "')";
	}else{
		$Sql = "UPDATE RAR_EQUIPE SET " .
			   " EQUIP_NOME = '" .$EQUIP_NOME. "', ".
			   " EQUIP_USUAR_IDO = '" .$EQUIP_USUAR_IDO. "' ".
			   " WHERE EQUIP_IDO = '" .$ID. "'";
	}
	
	$Stmt = mysql_query($Sql);
	header("Location: pesq_equipe.php");	
?>