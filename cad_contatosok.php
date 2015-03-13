<? include("inc/conn.inc.php");
	verifyAcess("CADCONTATO","S");

	$ID = $_POST["ID"];
	$CONT_IDO = modifyData($_POST["CONT_IDO"]);
	$CONT_NOME = modifyData($_POST["CONT_NOME"]);
	$CONT_EMAIL = modifyData($_POST["CONT_EMAIL"]);

	$Stmt = mysql_query("SELECT * FROM rar_contato WHERE CONT_IDO = '" .$CONT_IDO. "' " . ((trim($ID)) ? "AND CONT_IDO <> '" .$ID. "'" : ""));
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		header("Location: cad_contatos.php?ID=" .urlencode($ID).
			"&CONT_IDO=" .urlencode($CONT_IDO).
			"&CONT_NOME=" .urlencode($CONT_NOME).
			"&CONT_EMAIL=" .urlencode($CONT_EMAIL));
	}
    if (!trim($_POST["ID"])) {
    	$ID = newIDO();
		mysql_query("INSERT INTO rar_contato (CONT_IDO, CONT_NOME,CONT_EMAIL) VALUES ('$ID','$CONT_NOME','$CONT_EMAIL')");
	}else{
		mysql_query("UPDATE rar_contato SET CONT_NOME = '$CONT_NOME',CONT_EMAIL = '$CONT_EMAIL' WHERE CONT_IDO = '$ID'");
	}
	header("Location: pesq_contato.php");
?>