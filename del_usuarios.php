<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);

	$Stmt = mysql_query("DELETE FROM rar_usuario WHERE USUAR_IDO IN (" .$IDS. ")");
	$Stmt2 = mysql_query("DELETE FROM rar_acesso WHERE ACESS_USUAR_IDO IN (" .$IDS. ")");

	header("Location: pesq_usuarios.php");
?>