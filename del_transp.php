<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);

	$Stmt = mysql_query("DELETE FROM rar_transportadoras WHERE transp_ido IN (" .$IDS. ")");
	
	header("Location: pesq_transportadoras.php");	
?>