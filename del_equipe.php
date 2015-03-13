<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);
	$Stmt = mysql_query("DELETE FROM RAR_EQUIPE WHERE EQUIP_IDO IN (" .$IDS. ")");
	header("Location: pesq_equipe.php");	
?>