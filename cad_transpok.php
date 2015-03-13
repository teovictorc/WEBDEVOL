<? include("inc/conn.inc.php");
	verifyAcess("CADTRANSP","S");

	$ID = $_POST["ID"];
	$transp_ido     = modifyData($_POST["transp_ido"]);
	$transp_nome    = modifyData($_POST["transp_nome"]);
	$transp_contato = modifyData($_POST["transp_contato"]);
	$transp_email   = modifyData($_POST["transp_email"]);

	$Stmt = mysql_query("SELECT * FROM rar_transportadoras WHERE transp_ido = '" .$transp_ido. "' " . ((trim($ID)) ? "AND transp_ido <> '" .$ID. "'" : ""));
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		header("Location: cad_transp.php?ID=" .urlencode($ID).
			"&transp_ido=" .urlencode($transp_ido).
			"&transp_nome=" .urlencode($transp_nome).
			"&transp_email=" .urlencode($transp_email).
			"&transp_contato=" .urlencode($transp_contato));
	}
    if (!trim($_POST["ID"])) {
    	$ID = newIDO();
		mysql_query("INSERT INTO rar_transportadoras (transp_ido, transp_nome,transp_contato,transp_email) VALUES ('$ID','$transp_nome','$transp_contato','$transp_email')");
	}else{
		mysql_query("UPDATE rar_transportadoras SET transp_nome = '$transp_nome',transp_contato = '$transp_contato',transp_email = '$transp_email' WHERE transp_ido = '$ID'");
	}
	header("Location: pesq_transportadoras.php");
?>