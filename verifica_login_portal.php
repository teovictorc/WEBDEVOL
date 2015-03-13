<? include("inc/conn_externa.inc.php"); 
	
	$Codificado = $_GET["ID"];
	$ID = base64_decode($_GET["ID"]);
	$Data = substr($ID,0,10);
	$Data = str_replace(".","/",$Data);
	$Hora = substr($ID,11,5);
	$Hora = str_replace(".",":",$Hora);
	$User = substr($ID,17,500);
	
	$Sql = "select timediff(now(),'".strdata2db($Data)." ".$Hora."') as tempo from ido ";
	$StmtTempo = mysql_query($Sql);
	if ($Rs = mysql_fetch_assoc($StmtTempo)) {
		$Horas = substr($Rs["tempo"],0,2);
		$Minutos = substr($Rs["tempo"],3,2);
		if ($Horas > 1 || $Minutos > 5){
			header("Location: login.php?Error=4");
		}else{
			$Sql = "SELECT * FROM RAR_USUARIO WHERE USUAR_LOGIN = '" .$User. "'";
			$Stmt = mysql_query($Sql);
			if ($Rs = mysql_fetch_assoc($Stmt)) {
				if($Rs["USUAR_BLOQUEADO"] == "S") {
					header("Location: login.php?Error=2");
				}else{
					$_SESSION['sId'] = $Rs["USUAR_IDO"];
					$_SESSION['Menu'] = 1;
					$_SESSION['sNome'] = $Rs["USUAR_NOME"];
					header("Location: principal.php?Menu=1");
				}
			}else{
				header("Location: login.php?Error=5");
			}
		}
	}else{
		header("Location: login.php?Error=1");
	}
?>