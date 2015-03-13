<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);

	$Stmt = mysql_query("DELETE FROM rar_operadorloja WHERE opelj_ido IN (" .$IDS. ")");
	
	header("Location: pesq_operadorloja.php");	
?>