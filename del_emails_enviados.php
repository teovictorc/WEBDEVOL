<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);

	$Stmt = mysql_query("DELETE FROM rar_logemail WHERE LOG_IDO IN (" .$IDS. ")");
	
	header("Location: pesq_emails_enviados.php");	
?>