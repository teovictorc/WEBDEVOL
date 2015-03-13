<? include("inc/conn.inc.php"); 
	
	$IDS = str_replace("\'","'",$_GET["IdDel"]);
	$Stmt = mysql_query("DELETE FROM rar_defeito_subgrupo WHERE DEFEIS_DEFEIG_IDO IN (" .$IDS. ")");
	$Stmt = mysql_query("DELETE FROM rar_defeito_grupo WHERE DEFEIG_IDO IN (" .$IDS. ")");
	header("Location: pesq_defeitos_grupo.php");	
?>