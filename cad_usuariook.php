<? //include("inc/conn.inc.php");
   include("inc/conn.inc.php");
	verifyAcess("CADUSUARIO","T");	
	
	$ID = modifyData($_POST["ID"]);
	$USUAR_NOME = modifyData($_POST["USUAR_NOME"]);
	$USUAR_LOGIN = modifyData($_POST["USUAR_LOGIN"]);
	$USUAR_SENHA = modifyData($_POST["USUAR_SENHA"]);
	$USUAR_EMAIL1 = $_POST["USUAR_EMAIL1"];
	$USUAR_EMAIL2 = $_POST["USUAR_EMAIL2"];
	$USUAR_BLOQUEADO = $_POST["USUAR_BLOQUEADO"];
	$USUAR_EMAIL_PADRAO = $_POST["USUAR_EMAIL_PADRAO"];
	$USUAR_TIPOUSUARIO = $_POST["USUAR_TIPOUSUARIO"];
	$USUAR_ECONSULTOR = $_POST["USUAR_ECONSULTOR"];
	$USUAR_EFRANQUEADO = $_POST["USUAR_EFRANQUEADO"];
	$USUAR_CONSU_PESSOA = $_POST["USUAR_CONSU_PESSOA"];
	$USUAR_RESPONSAVELAUTOMATIVO = $_POST["USUAR_RESPONSAVELAUTOMATIVO"];
	$USUAR_RECEBEAUTOVINCULACAO = $_POST["USUAR_RECEBEAUTOVINCULACAO"];
	$USUAR_ACESSATODACARTEIRA = $_POST["USUAR_ACESSATODACARTEIRA"];
	$USUAR_ENVIAEMAILAUTOMATICO = $_POST["USUAR_ENVIAEMAILAUTOMATICO"];
	$USUAR_MODULOPADRAO = $_POST["USUAR_MODULOPADRAO"];
	$ACESS = $_POST['ACESS'];
	
	
	$Stmt = mysql_query("SELECT * FROM rar_usuario WHERE USUAR_LOGIN = '" .$USUAR_LOGIN. "' AND USUAR_IDO <> '" .$ID. "'");
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		header("Location: cad_usuarios.php?ID=" .$ID.
			"&ACESS=" .$ACESS.
			"&USUAR_NOME=" .urlencode($USUAR_NOME).
			"&USUAR_LOGIN=" .urlencode($USUAR_LOGIN).
			"&USUAR_SENHA=" .urlencode($USUAR_SENHA).
			"&USUAR_EMAIL1=" .urlencode($USUAR_EMAIL1).
			"&USUAR_EMAIL2=" .urlencode($USUAR_EMAIL2).
			"&USUAR_BLOQUEADO=" .$USUAR_BLOQUEADO.
			"&USUAR_TIPOUSUARIO=" .$USUAR_TIPOUSUARIO.
			"&USUAR_ECONSULTOR=" .$USUAR_ECONSULTOR.
			"&USUAR_ELOGISTICA=" .$USUAR_ELOGISTICA.
			"&USUAR_EFRANQUEADO=" .$USUAR_EFRANQUEADO.
			"&USUAR_CONSU_PESSOA=" .$USUAR_CONSU_PESSOA.
			"&USUAR_RESPONSAVELAUTOMATIVO=" .$USUAR_RESPONSAVELAUTOMATIVO.
			"&USUAR_RECEBEAUTOVINCULACAO=" .$USUAR_RECEBEAUTOVINCULACAO.
			"&USUAR_ACESSATODACARTEIRA=" .$USUAR_ACESSATODACARTEIRA.
			"&USUAR_ENVIAEMAILAUTOMATICO=" .$USUAR_ENVIAEMAILAUTOMATICO.
			"&USUAR_MODULOPADRAO=" .$USUAR_MODULOPADRAO.
			"&USUAR_EMAIL_PADRAO=" .$USUAR_EMAIL_PADRAO);
	}

	if (!trim($_POST["ID"])) {
		$ID = newIDO();
		$Sql = "INSERT INTO rar_usuario (USUAR_IDO," .
			   "USUAR_NOME,USUAR_LOGIN, " .
			   "USUAR_SENHA,USUAR_EMAIL1, " .
			   "USUAR_EMAIL2,USUAR_BLOQUEADO, " .
			   "USUAR_EMAILPADRAO, USUAR_TIPOUSUARIO, USUAR_ECONSULTOR, USUAR_CONSU_PESSOA,USUAR_RECEBEAUTOVINCULACAO, ".
			   "USUAR_RESPONSAVELAUTOMATIVO, USUAR_ELOGISTICA, USUAR_EFRANQUEADO, USUAR_ACESSATODACARTEIRA, USUAR_MODULOPADRAO, USUAR_ENVIAEMAILAUTOMATICO) VALUES ('" .
			   $ID . "', '" .$USUAR_NOME. "', '" .$USUAR_LOGIN. "', '" .
			   $USUAR_SENHA. "', '" .$USUAR_EMAIL1. "', '" .
			   $USUAR_EMAIL2. "', '" .$USUAR_BLOQUEADO. "', '" .
			   $USUAR_EMAIL_PADRAO. "','".$USUAR_TIPOUSUARIO."','".$USUAR_ECONSULTOR."','".$USUAR_CONSU_PESSOA."','".
			   $USUAR_RECEBEAUTOVINCULACAO."','".$USUAR_RESPONSAVELAUTOMATIVO."','".$USUAR_ELOGISTICA."','".$USUAR_EFRANQUEADO."','".
			   $USUAR_ACESSATODACARTEIRA."','".$USUAR_MODULOPADRAO."','".$USUAR_ENVIAEMAILAUTOMATICO."')";
	}else{
		$Sql = "UPDATE rar_usuario SET " .
			   "USUAR_NOME = '" .$USUAR_NOME. "' ".
			   ",USUAR_LOGIN = '" .$USUAR_LOGIN. "' ".
			   ",USUAR_SENHA = '" .$USUAR_SENHA. "' ".
			   ",USUAR_EMAIL1 = '" .$USUAR_EMAIL1. "' ".
			   ",USUAR_EMAIL2 = '" .$USUAR_EMAIL2. "' ".
			   ",USUAR_BLOQUEADO = '" .$USUAR_BLOQUEADO. "' ".
			   ",USUAR_TIPOUSUARIO = '" .$USUAR_TIPOUSUARIO. "' ".
			   ",USUAR_ECONSULTOR = '" .$USUAR_ECONSULTOR. "' ".
			   ",USUAR_ELOGISTICA = '" .$USUAR_ELOGISTICA. "' ".
			   ",USUAR_EFRANQUEADO = '" .$USUAR_EFRANQUEADO. "' ".
			   ",USUAR_CONSU_PESSOA = '" .$USUAR_CONSU_PESSOA. "' ".
			   ",USUAR_RESPONSAVELAUTOMATIVO = '".$USUAR_RESPONSAVELAUTOMATIVO. "' ".
			   ",USUAR_RECEBEAUTOVINCULACAO = '".$USUAR_RECEBEAUTOVINCULACAO. "' ".
			   ",USUAR_ACESSATODACARTEIRA = '".$USUAR_ACESSATODACARTEIRA. "' ".
			   ",USUAR_ENVIAEMAILAUTOMATICO = '".$USUAR_ENVIAEMAILAUTOMATICO. "' ".
			   ",USUAR_MODULOPADRAO = '".$USUAR_MODULOPADRAO. "' ".
			   ",USUAR_EMAILPADRAO = '" .$USUAR_EMAIL_PADRAO. "' WHERE USUAR_IDO = '" .$ID. "'";
	}
	//die($Sql);
	$Stmt = mysql_query($Sql);
	if ($Stmt) {
		if (trim($ID)) {
			$Sql = "DELETE FROM rar_acesso WHERE ACESS_USUAR_IDO = " .$ID;
			$Stmt = mysql_query($Sql);
		}
		if (trim($_POST['ACESS'])) {
			$Ids = explode(",",$ACESS);
			for($x = 0; $x < count($Ids); $x++) {
				$Data = explode("|",$Ids[$x]);
				$Sql = "INSERT INTO rar_acesso (ACESS_IDO,ACESS_TIPOACESSO,ACESS_USUAR_IDO,ACESS_PROGR_CODIGO) VALUES ('" . newIDO() .
				       "','" .$Data[0]. "'," .$ID. ",'" .$Data[1]. "')";
				$Stmt = mysql_query($Sql);
			}
		}
	}
	header("Location: pesq_usuarios.php");	
?>