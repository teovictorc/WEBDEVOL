<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);
	$Stmt = mysql_query("DELETE FROM RAR_PDV_PERGUNTA WHERE PERGU_IDO IN (" .$IDS. ")");
	header("Location: pesq_pergunta.php");	
?>