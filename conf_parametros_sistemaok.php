<? include("inc/conn.inc.php"); 
	verifyAcess("CONFIG_PARAMETRO","S");
	$CONFIG_EMAIL_ASSISTENTE = $_POST["CONFIG_EMAIL_ASSISTENTE"];
	$CONFIG_EMAIL_REVISOR = $_POST["CONFIG_EMAIL_REVISOR"];
	$CONFIG_EMAIL_GERENTE = $_POST["CONFIG_EMAIL_GERENTE"];
	$CONFIG_EMAIL_DIRETOR = $_POST["CONFIG_EMAIL_DIRETOR"];
	$CONFIG_EMAIL_PRESIDENTE = $_POST["CONFIG_EMAIL_PRESIDENTE"];
	$CONFIG_EMAIL_TRANSPORTADORA = $_POST["CONFIG_EMAIL_TRANSPORTADORA"];


	$Sql = "UPDATE RAR_CONFIG SET " .
		   "CONFIG_EMAIL_ASSISTENTE = '" .$CONFIG_EMAIL_ASSISTENTE. "' ".
		   ",CONFIG_EMAIL_REVISOR = '" .$CONFIG_EMAIL_REVISOR. "' ".
		   ",CONFIG_EMAIL_GERENTE = '" .$CONFIG_EMAIL_GERENTE. "' ".
		   ",CONFIG_EMAIL_DIRETOR = '" .$CONFIG_EMAIL_DIRETOR. "' ".
		   ",CONFIG_EMAIL_PRESIDENTE = '" .$CONFIG_EMAIL_PRESIDENTE. "' ".
		   ",CONFIG_EMAIL_TRANSPORTADORA = '" .$CONFIG_EMAIL_TRANSPORTADORA. "' ";

	$Stmt = mysql_query($Sql);

	header("Location: conf_parametros_sistema.php");
?>
