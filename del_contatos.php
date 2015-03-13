<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);

	$Stmt = mysql_query("DELETE FROM rar_contato WHERE CONT_IDO IN (" .$IDS. ")");
	
	header("Location: pesq_contato.php");	
?>