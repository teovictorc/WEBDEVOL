<? include("inc/conn.inc.php");

	$SCHAT_TEXTO = modifyData($_POST["SCHAT_TEXTO"]);
	$SCHAT_USUAR_DESTINATARIO = modifyData($_POST["SCHAT_USUAR_DESTINATARIO"]);
	$SCHAT_SERVI_NUMERO = modifyData($_POST["SERVI_NUMERO"]);
	$CLIENTE = modifyData($_POST["CLIENTE"]);
		
	if ($_GET['ID'] != ""){
		$Sql = "update rar_servico_chat set SCHAT_LIDO_DATA = now() where schat_ido = '".$_GET['ID']."'";
		mysql_query($Sql);
	}else{
		
	
		$ID = newIDO();
		$Sql = " INSERT INTO rar_servico_chat (SCHAT_IDO, SCHAT_USUAR_DESTINATARIO, SCHAT_SERVI_NUMERO, SCHAT_DATA, SCHAT_TEXTO, SCHAT_USUAR_IDO) ";
		$Sql.= " VALUES (";
		$Sql.= "'".$ID."',";
		$Sql.= "'".$SCHAT_USUAR_DESTINATARIO."', ";
		$Sql.= "'".$SCHAT_SERVI_NUMERO."',";
		$Sql.= "NOW(),";
		$Sql.= "'".$SCHAT_TEXTO."', ";
		$Sql.= "'".$_SESSION['sId']."')";
		mysql_query($Sql);
	}
		
	header("Location: chat.php?SERVI_NUMERO=".$SCHAT_SERVI_NUMERO."&ClienteNome=".$CLIENTE);
?>