<? include("inc/conn.inc.php");
	verifyAcess("CADOPERADORLOJA","S");

	$ID = $_POST["ID"];
	$opelj_ido     = modifyData($_POST["opelj_ido"]);
	$opelj_nome    = modifyData($_POST["opelj_nome"]);
	$opelj_email   = modifyData($_POST["opelj_email"]);
	
	if (verificar_email($opelj_email) != 1){
		
		header("Location: cad_operadorloja.php?Erro=1&ID=" .urlencode($ID).
			"&opelj_ido=" .urlencode($opelj_ido).
			"&opelj_nome=" .urlencode($opelj_nome).
			"&opelj_email=" .urlencode($opelj_email));
	}else{

		$Stmt = mysql_query("SELECT * FROM rar_operadorloja WHERE opelj_ido = '" .$opelj_ido. "' " . ((trim($ID)) ? "AND opelj_ido <> '" .$ID. "'" : ""));
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			header("Location: cad_operadorloja.php?ID=" .urlencode($ID).
				"&opelj_ido=" .urlencode($opelj_ido).
				"&opelj_nome=" .urlencode($opelj_nome).
				"&opelj_email=" .urlencode($opelj_email));
		}
		if (!trim($_POST["ID"])) {
			$ID = newIDO();
			mysql_query("INSERT INTO rar_operadorloja (opelj_ido, opelj_nome,opelj_email) VALUES ('$ID','$opelj_nome','$opelj_email')");
		}else{
			mysql_query("UPDATE rar_operadorloja SET opelj_nome = '$opelj_nome',opelj_email = '$opelj_email' WHERE opelj_ido = '$ID'");
		}
		header("Location: pesq_operadorloja.php");
	}
?>