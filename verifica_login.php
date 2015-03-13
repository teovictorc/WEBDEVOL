<? include("inc/conn_externa.inc.php"); 
	
	$LOGIN = modifyData($_POST["LOGIN"]);
	$SENHA = modifyData($_POST["SENHA"]);
	$Sql = "SELECT * FROM rar_usuario WHERE USUAR_LOGIN = '" .$LOGIN. "' AND USUAR_SENHA = '" .$SENHA. "'";
	$Stmt = mysql_query($Sql);
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		if($Rs["USUAR_BLOQUEADO"] == "S") {
			header("Location: default.php?Error=2");
		}else{
			$_SESSION['sId'] = $Rs["USUAR_IDO"];
			$_SESSION['Menu'] = 1;
			$_SESSION['sNome'] = $Rs["USUAR_NOME"];
			//header("Location: principal.php?Menu=1");
			header("Location: redireciona.php?Menu=".$Rs["USUAR_MODULOPADRAO"]);
		}
	}else{
		header("Location: default.php?Error=1");
	}
?>;
	}
?>