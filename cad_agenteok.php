<? include("inc/conn.inc.php");
	verifyAcess("CADAGENTE","S");

	$ID = $_POST["ID"];
	$agent_ido     = modifyData($_POST["agent_ido"]);
	$agent_nome    = modifyData($_POST["agent_nome"]);
	$agent_email   = modifyData($_POST["agent_email"]);
	
	if (verificar_email($agent_email) != 1){
		
		header("Location: cad_agente.php?Erro=1&ID=" .urlencode($ID).
			"&agent_ido=" .urlencode($agent_ido).
			"&agent_nome=" .urlencode($agent_nome).
			"&agent_email=" .urlencode($agent_email));
	}else{

		$Stmt = mysql_query("SELECT * FROM rar_agente WHERE agent_ido = '" .$agent_ido. "' " . ((trim($ID)) ? "AND agent_ido <> '" .$ID. "'" : ""));
		if ($Rs = mysql_fetch_assoc($Stmt)) {
			header("Location: cad_agente.php?ID=" .urlencode($ID).
				"&agent_ido=" .urlencode($agent_ido).
				"&agent_nome=" .urlencode($agent_nome).
				"&agent_email=" .urlencode($agent_email));
		}
		if (!trim($_POST["ID"])) {
			$ID = newIDO();
			mysql_query("INSERT INTO rar_agente (agent_ido, agent_nome,agent_email) VALUES ('$ID','$agent_nome','$agent_email')");
		}else{
			mysql_query("UPDATE rar_agente SET agent_nome = '$agent_nome',agent_email = '$agent_email' WHERE agent_ido = '$ID'");
		}
		header("Location: pesq_agente.php");
	}
?>