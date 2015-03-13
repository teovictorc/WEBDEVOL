<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);

	$Stmt = mysql_query("DELETE FROM RAR_PROGRAMA WHERE PROGR_CODIGO IN (" .$IDS. ")");
	header("Location: pesq_programas.php");	
?>